<?php

namespace App\Http\Controllers;

use App\DataTables\UserCateDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserCateRequest;
use App\Http\Requests\UpdateUserCateRequest;
use App\Repositories\UserCateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserCateController
 * @package App\Http\Controllers
 * @Controller(prefix="userCates")
 * @Resource("/userCates")
 * @Middleware({"cros", "auth", "bindings"})
 */
class UserCateController extends AppBaseController
{
    /** @var  UserCateRepository */
    private $userCateRepository;

    public function __construct(UserCateRepository $userCateRepo)
    {
        $this->userCateRepository = $userCateRepo;
    }

    /**
     * Display a listing of the UserCate.
     *
     * @param UserCateDataTable $userCateDataTable
     * @return Response
     */
    public function index(UserCateDataTable $userCateDataTable)
    {
        return $userCateDataTable->render('user_cates.index');
    }

    /**
     * Show the form for creating a new UserCate.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_cates.create');
    }

    /**
     * Store a newly created UserCate in storage.
     *
     * @param CreateUserCateRequest $request
     *
     * @return Response
     */
    public function store(CreateUserCateRequest $request)
    {
        $input = $request->all();

        $userCate = $this->userCateRepository->create($input);

        Flash::success('User Cate saved successfully.');

        return redirect(route('userCates.index'));
    }

    /**
     * Display the specified UserCate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userCate = $this->userCateRepository->findWithoutFail($id);

        if (empty($userCate)) {
            Flash::error('User Cate not found');

            return redirect(route('userCates.index'));
        }

        return view('user_cates.show')->with('userCate', $userCate);
    }

    /**
     * Show the form for editing the specified UserCate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userCate = $this->userCateRepository->findWithoutFail($id);

        if (empty($userCate)) {
            Flash::error('User Cate not found');

            return redirect(route('userCates.index'));
        }

        return view('user_cates.edit')->with('userCate', $userCate);
    }

    /**
     * Update the specified UserCate in storage.
     *
     * @param  int              $id
     * @param UpdateUserCateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserCateRequest $request)
    {
        $userCate = $this->userCateRepository->findWithoutFail($id);

        if (empty($userCate)) {
            Flash::error('User Cate not found');

            return redirect(route('userCates.index'));
        }

        $userCate = $this->userCateRepository->update($request->all(), $id);

        Flash::success('User Cate updated successfully.');

        return redirect(route('userCates.index'));
    }

    /**
     * Remove the specified UserCate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userCate = $this->userCateRepository->findWithoutFail($id);

        if (empty($userCate)) {
            Flash::error('User Cate not found');

            return redirect(route('userCates.index'));
        }

        $this->userCateRepository->delete($id);

        Flash::success('User Cate deleted successfully.');

        return redirect(route('userCates.index'));
    }
}
