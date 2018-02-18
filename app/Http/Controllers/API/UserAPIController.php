<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserAPIRequest;
use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response as ResponseClass;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 * @Controller(prefix="/api/users")
 * @Middleware({"cros", "api", "bindings"})
 */

class UserAPIController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;
    
    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('cros');
        $this->middleware('auth:api');
        $this->middleware('bindings');
        $this->userRepository = $userRepo;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     * @PUT("save-device-token/{user}", as="api.users.saveDeviceToken")
     * 
     * @SWG\Put(
     *   tags={"User"},
     *   path="/users/save-device-token/{userId}",
     *   description="This can only be done by the logged in user.",
     *   operationId="saveUserDeviceToken",
     *   produces={"application/json"},
     *   consumes={"application/json"},
     *   @SWG\Parameter(
     *     in="query",
     *     name="deviceToken",
     *     description="mobile device token",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     in="query",
     *     name="deviceType",
     *     description="mobile device type",
     *     required=true,
     *     type="string",
     *     enum={"android", "ios", "win"}
     *   ),
     *   @SWG\Parameter(ref="#/parameters/userId"),
     *   @SWG\Response(response="default", ref="#/responses/SuccessResponse")
     * )
     */
    public function saveDeviceToken(UpdateUserAPIRequest $request, User $user) {
        $all = $request->all();
        /*switch ($all['deviceType']) {
            case 'android':
                $all['device_type'] = 1;
                break;
            case 'ios':
                $all['device_type'] = 2;
                break;
        }*/
        $all['device_token'] = $all['deviceToken'];
        $user->update($all);
        //return $this->sendResponse($user->toArray(), 'User updated successfully');
        return response()->jsonSuccess(ResponseClass::HTTP_ACCEPTED);
    }

}
