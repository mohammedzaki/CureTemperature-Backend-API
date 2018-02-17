<?php

namespace App\DataTables;

use App\Models\Device;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Repositories\DeviceRepository;
use App\Criteria\{
    UserDevicesGetCriteria,
    AccountFilterCriteria,
    CategoryFilterCriteria
};

class DeviceDataTable extends DataTable {

    public $user;
    public $account;
    public $categoryId;
    public $deviceRepository;

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
                        ->addColumn('deviceCategoryName', function (Device $device) {
                            return $device->deviceCategory ? $device->deviceCategory->name : '';
                        })
                        ->addColumn('deviceAccountName', function (Device $device) {
                            return $device->deviceAccount ? $device->deviceAccount->name : '';
                        })
                        ->addColumn('action', 'devices.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Device $model)
    {
        if (isset($this->user)) {
            $this->deviceRepository = new DeviceRepository(app());
            $this->deviceRepository->pushCriteria(new UserDevicesGetCriteria($this->user));
            return $this->deviceRepository->getModelForDatatable();
        } elseif (isset($this->account)) {
            $this->deviceRepository = new DeviceRepository(app());
            $this->deviceRepository->pushCriteria(new AccountFilterCriteria($this->account->id));
            return $this->deviceRepository->getModelForDatatable();
        } elseif (isset($this->categoryId)) {
            $this->deviceRepository = new DeviceRepository(app());
            $this->deviceRepository->pushCriteria(new CategoryFilterCriteria($this->categoryId));
            return $this->deviceRepository->getModelForDatatable();
        } else {
            return $model->newQuery();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                        ->columns($this->getColumns())
                        ->minifiedAjax()
                        ->addAction(['width' => '80px'])
                        ->parameters([
                            'dom'     => 'Bfrtip',
                            'order'   => [[0, 'desc']],
                            'buttons' => [
                                'create',
                                'export',
                                'print',
                                'reset',
                                'reload',
                            ],
        ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'name',
            'serial_number',
            //'device_category_id',
            'deviceCategoryName',
            'deviceAccountName'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'devicesdatatable_' . time();
    }

}
