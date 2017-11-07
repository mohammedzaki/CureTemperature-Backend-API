<?php

namespace App\Repositories;

use App\Models\Role;

/**
 * Class RoleRepository
 * @package App\Repositories
 * @version November 1, 2017, 8:26 am UTC
 *
 * @method Role findWithoutFail($id, $columns = ['*'])
 * @method Role find($id, $columns = ['*'])
 * @method Role first($columns = ['*'])
 */
class RoleRepository extends MyBaseRepository {

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'display_name',
        'description'
    ];

    /**
     * Configure the Model
     * */
    public function model() {
        return Role::class;
    }

}
