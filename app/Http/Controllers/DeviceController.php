<?php

namespace App\Http\Controllers;

use App\DataTables\DeviceDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Repositories\DeviceRepository;
use App\Repositories\DeviceCategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DeviceController
 * @package App\Http\Controllers
 * @Controller(prefix="devices")
 * @Resource("/devices")
 * @Middleware({"cros", "web", "auth", "bindings"})
 */
class DeviceController extends AppBaseController
{
    /** @var  DeviceRepository */
    private $deviceRepository;

    /** @var  DeviceCategoryRepository */
    private $deviceCategoryRepository;
    
    public function __construct(DeviceRepository $deviceRepo, DeviceCategoryRepository $deviceCategoryRepo)
    {
        $this->deviceRepository = $deviceRepo;
        $this->deviceCategoryRepository = $deviceCategoryRepo;
    }

    /**
     * Display a listing of the Device.
     *
     * @param DeviceDataTable $deviceDataTable
     * @return Response
     */
    public function index(DeviceDataTable $deviceDataTable)
    {
        return $deviceDataTable->render('devices.index');
    }

    private function setViewData($device = null)
    {
        $categories = $this->deviceCategoryRepository->allForHtmlSelect();
        return [
            'categories' => $categories,
            'device'  => $device,
        ];
    }

    /**
     * Show the form for creating a new Device.
     *
     * @return Response
     */
    public function create()
    {
        return view('devices.create')->with($this->setViewData());
    }

    /**
     * Store a newly created Device in storage.
     *
     * @param CreateDeviceRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceRequest $request)
    {
        $input = $request->all();

        $device = $this->deviceRepository->create($input);

        Flash::success('Device saved successfully.');

        return redirect(route('devices.index'));
    }

    /**
     * Display the specified Device.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            Flash::error('Device not found');

            return redirect(route('devices.index'));
        }

        return view('devices.show')->with('device', $device);
    }

    /**
     * Show the form for editing the specified Device.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            Flash::error('Device not found');

            return redirect(route('devices.index'));
        }

        return view('devices.edit')->with($this->setViewData($device));
    }

    /**
     * Update the specified Device in storage.
     *
     * @param  int              $id
     * @param UpdateDeviceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceRequest $request)
    {
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            Flash::error('Device not found');

            return redirect(route('devices.index'));
        }

        $device = $this->deviceRepository->update($request->all(), $id);

        Flash::success('Device updated successfully.');

        return redirect(route('devices.index'));
    }

    /**
     * Remove the specified Device from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            Flash::error('Device not found');

            return redirect(route('devices.index'));
        }

        $this->deviceRepository->delete($id);

        Flash::success('Device deleted successfully.');

        return redirect(route('devices.index'));
    }
}
