<?php

namespace App\Http\Controllers;

use App\DataTables\{
    AccountDataTable,
    DeviceDataTable,
    UserDataTable
};
use App\Http\Requests;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Repositories\AccountRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DeviceCategoryController
 * @package App\Http\Controllers
 * @Controller(prefix="accounts")
 * @Resource("/accounts")
 * @Middleware({"cros", "web", "auth", "bindings"})
 */
class AccountController extends AppBaseController {

    /** @var  AccountRepository */
    private $accountRepository;

    public function __construct(AccountRepository $accountRepo)
    {
        $this->accountRepository = $accountRepo;
    }

    /**
     * Display a listing of the Account.
     *
     * @param AccountDataTable $accountDataTable
     * @return Response
     */
    public function index(AccountDataTable $accountDataTable)
    {
        return $accountDataTable->render('accounts.index');
    }

    /**
     * Show the form for creating a new Account.
     *
     * @return Response
     */
    public function create()
    {
        return view('accounts.create');
    }

    /**
     * Store a newly created Account in storage.
     *
     * @param CreateAccountRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountRequest $request)
    {
        $input = $request->all();

        $account = $this->accountRepository->create($input);

        Flash::success('Account saved successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Display the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.show')->with('account', $account);
    }

    /**
     * Show the form for editing the specified Account.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        return view('accounts.edit')->with('account', $account);
    }

    /**
     * Update the specified Account in storage.
     *
     * @param  int              $id
     * @param UpdateAccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountRequest $request)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $account = $this->accountRepository->update($request->all(), $id);

        Flash::success('Account updated successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified Account from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }

        $this->accountRepository->delete($id);

        Flash::success('Account deleted successfully.');

        return redirect(route('accounts.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     * @Get("/{account}/devices", as="user.getAccountDevices")
     */
    public function devices($id, DeviceDataTable $deviceDataTable)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }
        
        $deviceDataTable->account = $account;
        return $deviceDataTable->render('devices.index');
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     * @Get("/{account}/users", as="user.getAccountUsers")
     */
    public function users($id, UserDataTable $userDataTable)
    {
        $account = $this->accountRepository->findWithoutFail($id);

        if (empty($account)) {
            Flash::error('Account not found');

            return redirect(route('accounts.index'));
        }
        
        $userDataTable->account = $account;
        return $userDataTable->render('devices.index');
    }

}
