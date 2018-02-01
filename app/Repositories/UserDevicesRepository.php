<?php

namespace App\Repositories;

use App\Models\UserDevice;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserDevicesRepository
 * @package App\Repositories
 * @version November 13, 2017, 4:42 am UTC
 *
 * @method UserDevice findWithoutFail($id, $columns = ['*'])
 * @method UserDevice find($id, $columns = ['*'])
 * @method UserDevice first($columns = ['*'])
*/
class UserDevicesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'device_id',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserDevice::class;
    }
}
