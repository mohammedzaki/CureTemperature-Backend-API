<?php

namespace App\Repositories;

use App\Models\DeviceCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeviceCategoryRepository
 * @package App\Repositories
 * @version November 1, 2017, 8:39 am UTC
 *
 * @method DeviceCategory findWithoutFail($id, $columns = ['*'])
 * @method DeviceCategory find($id, $columns = ['*'])
 * @method DeviceCategory first($columns = ['*'])
*/
class DeviceCategoryRepository extends MyBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'min_temperature',
        'max_temperature',
        'alarm_times',
        'alarm_frequency'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DeviceCategory::class;
    }
}
