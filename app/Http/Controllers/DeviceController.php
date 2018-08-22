<?php

namespace App\Http\Controllers;

use App\DataTables\DeviceDataTable;
use App\Http\Requests\CreateDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Repositories\{
    DeviceRepository,
    DeviceCategoryRepository,
    AccountRepository
};
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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

    public function __construct(DeviceRepository $deviceRepo, DeviceCategoryRepository $deviceCategoryRepo, AccountRepository $accountRepo)
    {
        $this->deviceRepository         = $deviceRepo;
        $this->deviceCategoryRepository = $deviceCategoryRepo;
        $this->accountRepository        = $accountRepo;
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
        $accounts   = $this->accountRepository->allForHtmlSelect();
        return [
            'categories' => $categories,
            'device'     => $device,
            'accounts'   => $accounts
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * @Get("sendTestNotification/{id}", as="devices.sendTestNotification")
     */
    public function sendTestNotification(Request $request, $id)
    {
        $guzzle = new Client;
        $asHigh = isset($request->asHigh) ? $request->asHigh : true;

        $device = $this->deviceRepository->findWithoutFail($id);

        if (empty($device)) {
            Flash::error('Device not found');

            return redirect(route('devices.index'));
        }
        $serialNumber = $device->serial_number;
        if ($asHigh) {
            $temp = $device->deviceCategory->max_temperature + rand(3, 20);
        } else {
            $temp = $device->deviceCategory->min_temperature - rand(4, 21);
        }
        $response = $guzzle->get("https://api.thingspeak.com/update?api_key=2ICLU5MQB2KI82MS&field1=90&field2={$temp}&field3={$serialNumber}");

        Flash::success('TestNotification sent successfully.');

        return redirect(route('devices.index'));
    }

}
