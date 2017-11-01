<?php

namespace App\Repositories;

use App\Models\Device;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeviceRepository
 * @package App\Repositories
 * @version November 1, 2017, 8:57 am UTC
 *
 * @method Device findWithoutFail($id, $columns = ['*'])
 * @method Device find($id, $columns = ['*'])
 * @method Device first($columns = ['*'])
*/
class DeviceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'hospital',
        'place',
        'serial_number',
        'device_category_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Device::class;
    }
}
