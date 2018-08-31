<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeviceFeedsAPIRequest;
use App\Http\Requests\API\UpdateDeviceFeedsAPIRequest;
use App\Models\DeviceFeeds;
use App\Repositories\DeviceFeedsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DeviceRepository;
use App\Models\Device;
use Response;
use Notification;

/**
 * Class DeviceFeedsController
 * @package App\Http\Controllers\API
 * @Controller(prefix="/api/deviceFeeds")
 * @Resource("/api/deviceFeeds")
 * @Middleware({"cros", "api", "bindings"})
 */
class DeviceFeedsAPIController extends AppBaseController
{

    /** @var  DeviceFeedsRepository */
    private $deviceFeedsRepository;

    /** @var  DeviceRepository */
    private $deviceRepository;

    public function __construct(DeviceFeedsRepository $deviceFeedsRepo, DeviceRepository $deviceRepo)
    {
        $this->deviceFeedsRepository = $deviceFeedsRepo;
        $this->deviceRepository      = $deviceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deviceFeedsRepository->pushCriteria(new RequestCriteria($request));
        $this->deviceFeedsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $deviceFeeds = $this->deviceFeedsRepository->all();

        return $this->sendResponse($deviceFeeds->toArray(), 'Device Feeds retrieved successfully');
    }

    /**
     * @param CreateDeviceFeedsAPIRequest $request
     * @return Response
     */
    public function store(CreateDeviceFeedsAPIRequest $request)
    {
        logger('reciveThingSpeakData: ', $request->all());
        //$reciveThingSpeakData = $request->all();

        $input = $request->all();

        $device = $this->deviceRepository->findByField('serial_number', $request->serial_number)->first();

        $input['device_id'] = $device->id;

        $deviceFeeds = $this->deviceFeedsRepository->create($input);

        $this->checkDeviceTemprature($device, $request->temperature);

        return $this->sendResponse($deviceFeeds->toArray(), 'Device Feeds saved successfully');
    }

    private function checkDeviceTemprature(Device $device, $temp)
    {
        $deviceCategory  = $device->deviceCategory;
        $users           = $device->users;
        $device->alarm   = 0;
        $device->temp    = $temp;
        $device->reverse = ($temp < 0);

        if ($temp > $deviceCategory->max_temperature) {
            $device->alarm = 1;

            Notification::send($users, new TempNotification($device, $temp, true));

            logger("(high) Notification sent to users: ", collect($users)->all());
        } else if ($temp < $deviceCategory->min_temperature) {
            $device->alarm = 1;

            Notification::send($users, new TempNotification($device, $temp, false));

            logger("(low) Notification sent to users: ", collect($users)->all());
        }
        $device->save();
    }

    /**
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        /** @var DeviceFeeds $deviceFeeds */
        $deviceFeeds = $this->deviceFeedsRepository->findWithoutFail($id);

        if (empty($deviceFeeds)) {
            return $this->sendError('Device Feeds not found');
        }

        return $this->sendResponse($deviceFeeds->toArray(), 'Device Feeds retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDeviceFeedsAPIRequest $request
     * @return Response
     */
    public function update($id, UpdateDeviceFeedsAPIRequest $request)
    {
        $input = $request->all();

        /** @var DeviceFeeds $deviceFeeds */
        $deviceFeeds = $this->deviceFeedsRepository->findWithoutFail($id);

        if (empty($deviceFeeds)) {
            return $this->sendError('Device Feeds not found');
        }

        $deviceFeeds = $this->deviceFeedsRepository->update($input, $id);

        return $this->sendResponse($deviceFeeds->toArray(), 'DeviceFeeds updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DeviceFeeds $deviceFeeds */
        $deviceFeeds = $this->deviceFeedsRepository->findWithoutFail($id);

        if (empty($deviceFeeds)) {
            return $this->sendError('Device Feeds not found');
        }

        $deviceFeeds->delete();

        return $this->sendResponse($id, 'Device Feeds deleted successfully');
    }

    /**
     * @SWG\Get(
     *   tags={"Device"},
     *   path="/deviceFeeds/getDeviceHistory/{deviceId}",
     *   operationId="getDeviceHistory",
     *   @SWG\Parameter(ref="#/parameters/deviceId"),
     *   @SWG\Parameter(
     *     in="query",
     *     name="startDate",
     *     description="Start Date of history",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     in="query",
     *     name="endDate",
     *     description="End Date of history",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response="default", ref="#/responses/deviceHistory")
     * )
     * 
     * @param Device $device
     * @return Response
     * @Get("getDeviceHistory/{device}", as="deviceFeeds.getDeviceHistory")
     */
    public function getDeviceHistory(Request $request, Device $device)
    {
        $result = $device->deviceFeeds()
                ->whereBetween('created_at', [$request->startDate, $request->endDate])
                ->get();
        $data['history'] = $result->map(function ($item) {
            return $item->temperature;
        });
        $data['dates'] = $result->map(function ($item) {
            return $item->created_at->format('d-M H:i');
        });
        return $this->sendResponse($data, 'User Devices retrieved successfully');
    }

}
