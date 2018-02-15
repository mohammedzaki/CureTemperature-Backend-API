<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUserDevicesAPIRequest;
use App\Http\Requests\API\UpdateUserDevicesAPIRequest;
use App\Models\UserDevices;
use App\Models\User;
use App\Repositories\{UserDevicesRepository,
DeviceRepository};
use App\Criteria\UserDevicesGetCriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class UserDevicesController
 * @package App\Http\Controllers\API
 * @Controller(prefix="/api/userDevices")
 * @Middleware({"cros", "api", "bindings"})
 * 
 * @SWG\Path(
 *   path="/userDevices/{userId}",
 *   @SWG\Parameter(ref="#/parameters/userId")
 * )
 */
class UserDevicesAPIController extends AppBaseController {

    /** @var  UserDevicesRepository */
    private $userDevicesRepository;
    
    /** @var  UserDevicesRepository */
    private $deviceRepository;

    public function __construct(UserDevicesRepository $userDevicesRepo, DeviceRepository $deviceRepo)
    {
        $this->userDevicesRepository = $userDevicesRepo;
        $this->deviceRepository = $deviceRepo;
    }


    public function setPreferedDevice(Request $request, $userId)
    {
        
    }

    public function getPreferedDevices($userId)
    {
        
    }
    
    /**
     * @SWG\Get(
     *   tags={"UserDevices"},
     *   path="/userDevices/{userId}",
     *   @SWG\Parameter(ref="#/parameters/userId"),
     *   @SWG\Response(response="default", ref="#/responses/device")
     * )
     * @Get("/{user}", as="userDevices.getUserDevices")
     */
    public function getUserDevices(Request $request, User $user)
    {
        $this->deviceRepository->pushCriteria(new UserDevicesGetCriteria($user));
        $userDevices = $this->deviceRepository->all();
        return $this->sendResponse($userDevices->toArray(), 'User Devices retrieved successfully');
    }

}
