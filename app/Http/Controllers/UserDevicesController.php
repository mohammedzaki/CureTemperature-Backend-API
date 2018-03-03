<?php

namespace App\Http\Controllers;

use App\DataTables\UserDevicesDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserDevicesRequest;
use App\Http\Requests\UpdateUserDevicesRequest;
use App\Repositories\UserDevicesRepository;
use App\Repositories\DeviceRepository;
use App\Repositories\UserRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UserDevicesController
 * @package App\Http\Controllers
 * @Controller(prefix="userDevices")
 * @Resource("/userDevices")
 * @Middleware({"cros", "web", "auth", "bindings"})
 */
class UserDevicesController extends AppBaseController
{
    /** @var  UserDevicesRepository */
    private $userDevicesRepository;
    
    /** @var  UserRepository */
    private $userRepository;
    
    /** @var  DeviceRepository */
    private $deviceRepository;

    public function __construct(UserDevicesRepository $userDevicesRepo, DeviceRepository $deviceRepo, UserRepository $userRepo)
    {
        $this->userDevicesRepository = $userDevicesRepo;
        $this->userRepository = $userRepo;
        $this->deviceRepository = $deviceRepo;
    }

    private function setViewData($userDevice = null)
    {
        $devices = $this->deviceRepository->allForHtmlSelect();
        $users = $this->userRepository->allForHtmlSelect();
        return [
            'users' => $users,
            'devices' => $devices,
            'userDevices'  => $userDevice,
        ];
    }
    /**
     * Display a listing of the UserDevices.
     *
     * @param UserDevicesDataTable $userDevicesDataTable
     * @return Response
     */
    public function index(UserDevicesDataTable $userDevicesDataTable)
    {
        return $userDevicesDataTable->render('user_devices.index');
    }

    /**
     * Show the form for creating a new UserDevices.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_devices.create')->with($this->setViewData());
    }

    /**
     * Store a newly created UserDevices in storage.
     *
     * @param CreateUserDevicesRequest $request
     *
     * @return Response
     */
    public function store(CreateUserDevicesRequest $request)
    {
        $input = $request->all();

        $userDevices = $this->userDevicesRepository->create($input);
        
        Flash::success('User Devices saved successfully.');

        return redirect(route('userDevices.index'));
    }

    /**
     * Display the specified UserDevices.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userDevices = $this->userDevicesRepository->findWithoutFail($id);

        if (empty($userDevices)) {
            Flash::error('User Devices not found');

            return redirect(route('userDevices.index'));
        }

        return view('user_devices.show')->with($this->setViewData($userDevices));
    }

    /**
     * Show the form for editing the specified UserDevices.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userDevices = $this->userDevicesRepository->findWithoutFail($id);

        if (empty($userDevices)) {
            Flash::error('User Devices not found');

            return redirect(route('userDevices.index'));
        }

        return view('user_devices.edit')->with($this->setViewData($userDevices));
    }

    /**
     * Update the specified UserDevices in storage.
     *
     * @param  int              $id
     * @param UpdateUserDevicesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserDevicesRequest $request)
    {
        $userDevices = $this->userDevicesRepository->findWithoutFail($id);

        if (empty($userDevices)) {
            Flash::error('User Devices not found');

            return redirect(route('userDevices.index'));
        }

        $userDevices = $this->userDevicesRepository->update($request->all(), $id);

        Flash::success('User Devices updated successfully.');

        return redirect(route('userDevices.index'));
    }

    /**
     * Remove the specified UserDevices from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userDevices = $this->userDevicesRepository->findWithoutFail($id);

        if (empty($userDevices)) {
            Flash::error('User Devices not found');

            return redirect(route('userDevices.index'));
        }

        $this->userDevicesRepository->delete($id);

        Flash::success('User Devices deleted successfully.');

        return redirect(route('userDevices.index'));
    }
}
