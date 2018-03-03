<?php

namespace App\DataTables;

use App\Models\UserDevice;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class UserDevicesDataTable extends DataTable {

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
                        ->addColumn('deviceName', function (UserDevice $device) {
                            return $device->device->name ?: '';
                        })
                        ->addColumn('userName', function (UserDevice $device) {
                            return $device->user->name ?: '';
                        })
                        ->addColumn('deviceAccountName', function (UserDevice $device) {
                            return isset($device->device->deviceAccount) ? $device->device->deviceAccount->name : '';
                        })
                        ->addColumn('action', 'user_devices.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(UserDevice $model)
    {
        return $model->newQuery();
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
            'deviceName',
            'userName',
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
        return 'user_devicesdatatable_' . time();
    }

}
