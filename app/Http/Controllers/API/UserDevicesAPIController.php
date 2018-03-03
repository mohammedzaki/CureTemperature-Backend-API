<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\{
    User
};
use App\Repositories\{
    UserDevicesRepository,
    DeviceRepository
};
use App\Criteria\{
    UserDevicesCriteria,
    PreferedDevicesCriteria
};

/**
 * Class UserDevicesController
 * @package App\Http\Controllers\API
 * @Controller(prefix="/api/userDevices")
 * @Middleware({"cros", "api", "bindings"})
 */
class UserDevicesAPIController extends AppBaseController {

    /** @var  UserDevicesRepository */
    private $userDevicesRepository;

    /** @var  UserDevicesRepository */
    private $deviceRepository;

    public function __construct(UserDevicesRepository $userDevicesRepo, DeviceRepository $deviceRepo)
    {
        $this->userDevicesRepository = $userDevicesRepo;
        $this->deviceRepository      = $deviceRepo;
    }
    
    /**
     * @SWG\Get(
     *   tags={"UserDevices"},
     *   path="/userDevices/{userId}",
     *   operationId="getUserDevices",
     *   @SWG\Parameter(ref="#/parameters/userId"),
     *   @SWG\Parameter(
     *     in="query",
     *     name="devicesId",
     *     description="List of devices IDs",
     *     required=false,
     *     type="array",
     *     @SWG\Items(type="integer")
     *   ),
     *   @SWG\Response(response="default", ref="#/responses/device")
     * )
     * @Get("/{user}", as="userDevices.getUserDevices")
     */
    public function getUserDevices(Request $request, User $user)
    {
        if (isset($request->devicesId)) {
            $integerIDs = array_map('intval', explode(',', $request->devicesId));
            $this->deviceRepository->pushCriteria(new PreferedDevicesCriteria($integerIDs));
        } else {
            //$this->deviceRepository->pushCriteria(new UserDevicesCriteria($user));
        }
        $this->deviceRepository->pushCriteria(new UserDevicesCriteria($user));
        //echo $this->deviceRepository->getModelForDatatable();
        $userDevices = $this->deviceRepository->all();
        $data['account'] = $user->account;
        $data['devices'] = $this->deviceRepository->all()->toArray();
        
        return $this->sendResponse($data, 'User Devices retrieved successfully');
    }

}
