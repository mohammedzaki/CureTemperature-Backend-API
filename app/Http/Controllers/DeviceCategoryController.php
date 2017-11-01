<?php

namespace App\Http\Controllers;

use App\DataTables\DeviceCategoryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDeviceCategoryRequest;
use App\Http\Requests\UpdateDeviceCategoryRequest;
use App\Repositories\DeviceCategoryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DeviceCategoryController extends AppBaseController
{
    /** @var  DeviceCategoryRepository */
    private $deviceCategoryRepository;

    public function __construct(DeviceCategoryRepository $deviceCategoryRepo)
    {
        $this->deviceCategoryRepository = $deviceCategoryRepo;
    }

    /**
     * Display a listing of the DeviceCategory.
     *
     * @param DeviceCategoryDataTable $deviceCategoryDataTable
     * @return Response
     */
    public function index(DeviceCategoryDataTable $deviceCategoryDataTable)
    {
        return $deviceCategoryDataTable->render('device_categories.index');
    }

    /**
     * Show the form for creating a new DeviceCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('device_categories.create');
    }

    /**
     * Store a newly created DeviceCategory in storage.
     *
     * @param CreateDeviceCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateDeviceCategoryRequest $request)
    {
        $input = $request->all();

        $deviceCategory = $this->deviceCategoryRepository->create($input);

        Flash::success('Device Category saved successfully.');

        return redirect(route('deviceCategories.index'));
    }

    /**
     * Display the specified DeviceCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deviceCategory = $this->deviceCategoryRepository->findWithoutFail($id);

        if (empty($deviceCategory)) {
            Flash::error('Device Category not found');

            return redirect(route('deviceCategories.index'));
        }

        return view('device_categories.show')->with('deviceCategory', $deviceCategory);
    }

    /**
     * Show the form for editing the specified DeviceCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deviceCategory = $this->deviceCategoryRepository->findWithoutFail($id);

        if (empty($deviceCategory)) {
            Flash::error('Device Category not found');

            return redirect(route('deviceCategories.index'));
        }

        return view('device_categories.edit')->with('deviceCategory', $deviceCategory);
    }

    /**
     * Update the specified DeviceCategory in storage.
     *
     * @param  int              $id
     * @param UpdateDeviceCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeviceCategoryRequest $request)
    {
        $deviceCategory = $this->deviceCategoryRepository->findWithoutFail($id);

        if (empty($deviceCategory)) {
            Flash::error('Device Category not found');

            return redirect(route('deviceCategories.index'));
        }

        $deviceCategory = $this->deviceCategoryRepository->update($request->all(), $id);

        Flash::success('Device Category updated successfully.');

        return redirect(route('deviceCategories.index'));
    }

    /**
     * Remove the specified DeviceCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deviceCategory = $this->deviceCategoryRepository->findWithoutFail($id);

        if (empty($deviceCategory)) {
            Flash::error('Device Category not found');

            return redirect(route('deviceCategories.index'));
        }

        $this->deviceCategoryRepository->delete($id);

        Flash::success('Device Category deleted successfully.');

        return redirect(route('deviceCategories.index'));
    }
}
