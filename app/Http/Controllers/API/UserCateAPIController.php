<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserCateAPIRequest;
use App\Http\Requests\API\UpdateUserCateAPIRequest;
use App\Models\UserCate;
use App\Repositories\UserCateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class UserCateController
 * @package App\Http\Controllers\API
 * @Controller(prefix="/api/user_cates")
 * @Resource("/api/user_cates")
 * @Middleware({"cros", "api", "bindings"})
 */

class UserCateAPIController extends AppBaseController
{
    /** @var  UserCateRepository */
    private $userCateRepository;

    public function __construct(UserCateRepository $userCateRepo)
    {
        $this->userCateRepository = $userCateRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/userCates",
     *      summary="Get a listing of the UserCates.",
     *      tags={"UserCate"},
     *      description="Get all UserCates",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/UserCate")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->userCateRepository->pushCriteria(new RequestCriteria($request));
        $this->userCateRepository->pushCriteria(new LimitOffsetCriteria($request));
        $userCates = $this->userCateRepository->all();

        return $this->sendResponse($userCates->toArray(), 'User Cates retrieved successfully');
    }

    /**
     * @param CreateUserCateAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/userCates",
     *      summary="Store a newly created UserCate in storage",
     *      tags={"UserCate"},
     *      description="Store UserCate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserCate that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserCate")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/UserCate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUserCateAPIRequest $request)
    {
        $input = $request->all();

        $userCates = $this->userCateRepository->create($input);

        return $this->sendResponse($userCates->toArray(), 'User Cate saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/userCates/{id}",
     *      summary="Display the specified UserCate",
     *      tags={"UserCate"},
     *      description="Get UserCate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserCate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/UserCate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var UserCate $userCate */
        $userCate = $this->userCateRepository->findWithoutFail($id);

        if (empty($userCate)) {
            return $this->sendError('User Cate not found');
        }

        return $this->sendResponse($userCate->toArray(), 'User Cate retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUserCateAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/userCates/{id}",
     *      summary="Update the specified UserCate in storage",
     *      tags={"UserCate"},
     *      description="Update UserCate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserCate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UserCate that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UserCate")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/UserCate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUserCateAPIRequest $request)
    {
        $input = $request->all();

        /** @var UserCate $userCate */
        $userCate = $this->userCateRepository->findWithoutFail($id);

        if (empty($userCate)) {
            return $this->sendError('User Cate not found');
        }

        $userCate = $this->userCateRepository->update($input, $id);

        return $this->sendResponse($userCate->toArray(), 'UserCate updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/userCates/{id}",
     *      summary="Remove the specified UserCate from storage",
     *      tags={"UserCate"},
     *      description="Delete UserCate",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UserCate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var UserCate $userCate */
        $userCate = $this->userCateRepository->findWithoutFail($id);

        if (empty($userCate)) {
            return $this->sendError('User Cate not found');
        }

        $userCate->delete();

        return $this->sendResponse($id, 'User Cate deleted successfully');
    }
}
