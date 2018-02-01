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
        $this->deviceRepository = $deviceRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/deviceFeeds",
     *      summary="Get a listing of the DeviceFeeds.",
     *      tags={"DeviceFeeds"},
     *      description="Get all DeviceFeeds",
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
     *                  @SWG\Items(ref="#/definitions/DeviceFeeds")
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
        $this->deviceFeedsRepository->pushCriteria(new RequestCriteria($request));
        $this->deviceFeedsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $deviceFeeds = $this->deviceFeedsRepository->all();

        return $this->sendResponse($deviceFeeds->toArray(), 'Device Feeds retrieved successfully');
    }

    /**
     * @param CreateDeviceFeedsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/deviceFeeds",
     *      summary="Store a newly created DeviceFeeds in storage",
     *      tags={"DeviceFeeds"},
     *      description="Store DeviceFeeds",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="DeviceFeeds that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/DeviceFeeds")
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
     *                  ref="#/definitions/DeviceFeeds"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
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
    
    private function checkDeviceTemprature(Device $device, $temp) {
        $deviceCategory = $device->deviceCategory;
        $users = $device->users;
        
        if ($temp > $deviceCategory->max_temperature) {
            
            Notification::send($users, new TempNotification($device, $temp, true));
            
            logger("(high) Notification sent to users: ", collect($users)->all());
            
        } else if ($temp < $deviceCategory->min_temperature) {
            
            Notification::send($users, new TempNotification($device, $temp, false));
            
            logger("(low) Notification sent to users: ", collect($users)->all());
            
        }
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/deviceFeeds/{id}",
     *      summary="Display the specified DeviceFeeds",
     *      tags={"DeviceFeeds"},
     *      description="Get DeviceFeeds",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of DeviceFeeds",
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
     *                  ref="#/definitions/DeviceFeeds"
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
     *
     * @SWG\Put(
     *      path="/deviceFeeds/{id}",
     *      summary="Update the specified DeviceFeeds in storage",
     *      tags={"DeviceFeeds"},
     *      description="Update DeviceFeeds",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of DeviceFeeds",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="DeviceFeeds that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/DeviceFeeds")
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
     *                  ref="#/definitions/DeviceFeeds"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
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
     *
     * @SWG\Delete(
     *      path="/deviceFeeds/{id}",
     *      summary="Remove the specified DeviceFeeds from storage",
     *      tags={"DeviceFeeds"},
     *      description="Delete DeviceFeeds",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of DeviceFeeds",
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
        /** @var DeviceFeeds $deviceFeeds */
        $deviceFeeds = $this->deviceFeedsRepository->findWithoutFail($id);

        if (empty($deviceFeeds)) {
            return $this->sendError('Device Feeds not found');
        }

        $deviceFeeds->delete();

        return $this->sendResponse($id, 'Device Feeds deleted successfully');
    }
}
