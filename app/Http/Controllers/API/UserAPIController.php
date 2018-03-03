<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\UpdateUserAPIRequest;
use App\Models\{
    User
};
use App\Repositories\{
    UserRepository,
    UserDevicesRepository,
    DeviceRepository
};
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response as ResponseClass;
use App\Criteria\UserDevicesNotificationsCriteria;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 * @Controller(prefix="/api/users")
 * @Middleware({"cros", "api", "bindings"})
 */
class UserAPIController extends AppBaseController {

    /** @var  UserRepository */
    private $userRepository;

    /** @var  UserDevicesRepository */
    private $deviceRepository;

    public function __construct(UserRepository $userRepo, DeviceRepository $deviceRepo)
    {
        $this->userRepository   = $userRepo;
        $this->deviceRepository = $deviceRepo;
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
    public function saveDeviceToken(UpdateUserAPIRequest $request, User $user)
    {
        $all                 = $request->all();
        /* switch ($all['deviceType']) {
          case 'android':
          $all['device_type'] = 1;
          break;
          case 'ios':
          $all['device_type'] = 2;
          break;
          } */
        $all['device_token'] = $all['deviceToken'];
        $user->update($all);
        //return $this->sendResponse($user->toArray(), 'User updated successfully');
        return response()->jsonSuccess(ResponseClass::HTTP_ACCEPTED);
    }

    /**
     * @SWG\Get(
     *   tags={"User"},
     *   path="/users/getUserNotifications/{userId}",
     *   operationId="getUserNotifications",
     *   @SWG\Parameter(ref="#/parameters/userId"),
     *   @SWG\Response(response="default", ref="#/responses/device")
     * )
     * @Get("/getUserNotifications/{user}", as="userDevices.getUserNotifications")
     */
    public function getUserNotifications(Request $request, User $user)
    {
        $this->deviceRepository->pushCriteria(new UserDevicesNotificationsCriteria($user));
        $userDevices     = $this->deviceRepository->all();
        $data['account'] = $user->account;
        $data['notifications'] = $this->deviceRepository->all()->toArray();

        return $this->sendResponse($data, 'User Devices retrieved successfully');
    }

}
