<?php

namespace App\Http\Controllers;

use App\DataTables\DeviceFeedsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDeviceFeedsRequest;
use App\Http\Requests\UpdateDeviceFeedsRequest;
use App\Repositories\DeviceFeedsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DeviceFeedsController
 * @package App\Http\Controllers
 * @Controller(prefix="deviceFeeds")
 * @Resource("/deviceFeeds")
 * @Middleware({"cros", "web", "auth", "bindings"})
 */
class DeviceFeedsController extends AppBaseController
{
    /** @var  DeviceFeedsRepository */
    private $deviceFeedsRepository;

    public function __construct(DeviceFeedsRepository $deviceFeedsRepo)
    {
        $this->deviceFeedsRepository = $deviceFeedsRepo;
    }

    /**
     * Display a listing of the DeviceFeeds.
     *
     * @param DeviceFeedsDataTable $deviceFeedsDataTable
     * @return Response
     */
    public function index(DeviceFeedsDataTable $deviceFeedsDataTable)
    {
        return $deviceFeedsDataTable->render('device_feeds.index');
    }

    /**
     * Show the form for creating a new DeviceFeeds.
     *
     * @return Response
     */
    public function create()
    {
        return view('device_feeds.create');
    }

    /**
     * Store a newly created DeviceFeeds in storage.
     *
     * @param CreateDeviceFeedsRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceFeedsRequest $request)
    {
        $input = $request->all();

        $deviceFeeds = $this->deviceFeedsRepository->create($input);

        Flash::success('Device Feeds saved successfully.');

        return redirect(route('deviceFeeds.index'));
    }

    /**
     * Display the specified DeviceFeeds.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deviceFeeds = $this->deviceFeedsRepository->findWithoutFail($id);

        if (empty($deviceFeeds)) {
            Flash::error('Device Feeds not found');

            return redirect(route('deviceFeeds.index'));
        }

        return view('device_feeds.show')->with('deviceFeeds', $deviceFeeds);
    }

    /**
     * Show the form for editing the specified DeviceFeeds.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deviceFeeds = $this->deviceFeedsRepository->findWithoutFail($id);

        if (empty($deviceFeeds)) {
            Flash::error('Device Feeds not found');

            return redirect(route('deviceFeeds.index'));
        }

        return view('device_feeds.edit')->with('deviceFeeds', $deviceFeeds);
    }

    /**
     * Update the specified DeviceFeeds in storage.
     *
     * @param  int              $id
     * @param UpdateDeviceFeedsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceFeedsRequest $request)
    {
        $deviceFeeds = $this->deviceFeedsRepository->findWithoutFail($id);

        if (empty($deviceFeeds)) {
            Flash::error('Device Feeds not found');

            return redirect(route('deviceFeeds.index'));
        }

        $deviceFeeds = $this->deviceFeedsRepository->update($request->all(), $id);

        Flash::success('Device Feeds updated successfully.');

        return redirect(route('deviceFeeds.index'));
    }

    /**
     * Remove the specified DeviceFeeds from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deviceFeeds = $this->deviceFeedsRepository->findWithoutFail($id);

        if (empty($deviceFeeds)) {
            Flash::error('Device Feeds not found');

            return redirect(route('deviceFeeds.index'));
        }

        $this->deviceFeedsRepository->delete($id);

        Flash::success('Device Feeds deleted successfully.');

        return redirect(route('deviceFeeds.index'));
    }
}
