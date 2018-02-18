<?php

namespace App\DataTables;

use App\Models\User;
use App\Repositories\UserRepository;
use Yajra\DataTables\EloquentDataTable;
use App\Criteria\AccountFilterCriteria;

class UserDataTable extends MyBaseDataTable {

    public $account;
    public $userRepository;

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
                        //->addColumn('details', 'users.datatables_details')
                        ->addColumn('devices_details_url', function(User $user) {
                            return url("users/{$user->id}/devices");
                        })
                        ->addColumn('accountName', function (User $user) {
                            return $user->account ? $user->account->name : '';
                        })
                        ->addColumn('userRoleName', function (User $user) {
                            return $user->roles->first() ? $user->roles->first()->display_name : '';
                        })
                        ->addColumn('action', 'users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        if (isset($this->account)) {
            $this->userRepository = new UserRepository(app());
            $this->userRepository->pushCriteria(new AccountFilterCriteria($this->account->id));
            return $this->userRepository->getModelForDatatable();
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
                        ->addAction(['width' => '120px'])
                        ->parameters([
                            'dom'     => 'Bfrtip',
                            'order'   => [[0, 'asc']],
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
            'id',
            'name',
            'email',
            'accountName',
            'userRoleName'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'usersdatatable_' . time();
    }

}
