<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\DataTables\DeviceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Repositories\{
    UserRepository,
    RoleRepository,
    AccountRepository
};
use Response;

/**
 * Class UserController
 * @package App\Http\Controllers
 * @Controller(prefix="users")
 * @Resource("/users")
 * @Middleware({"cros", "web", "auth", "bindings"})
 */
class UserController extends AppBaseController {

    /** @var  UserRepository */
    private $userRepository;

    /** @var  RoleRepository */
    private $roleRepository;

    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo, AccountRepository $accountRepo)
    {
        $this->userRepository    = $userRepo;
        $this->roleRepository    = $roleRepo;
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('users.index');
    }

    private function setViewData($user = null)
    {
        $roles    = $this->roleRepository->allForHtmlSelect('display_name');
        $accounts = $this->accountRepository->allForHtmlSelect();
        return [
            'roles'    => $roles,
            'user'     => $user,
            'accounts' => $accounts
        ];
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {

        return view('users.create')->with($this->setViewData());
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $input['password'] = bcrypt($input['password']);

        $user = $this->userRepository->create($input);

        $user->roles()->attach($request->role);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (!empty($user->roles()->first()))
            $user['role'] = $user->roles()->first()->id;

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with($this->setViewData($user)); //->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        }

        $user = $this->userRepository->update($input, $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     * @Get("/{user}/devices", as="user.getUserDevices")
     */
    public function devices($id, DeviceDataTable $deviceDataTable)
    {
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        //$this->deviceRepository->pushCriteria(new UserDevicesGetCriteria($user));
        $deviceDataTable->user = $user;
        return $deviceDataTable->render('devices.index');
    }

}
