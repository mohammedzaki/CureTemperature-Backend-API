<?php

namespace App\Repositories;

use App\Models\DeviceFeeds;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DeviceFeedsRepository
 * @package App\Repositories
 * @version November 13, 2017, 4:41 am UTC
 *
 * @method DeviceFeeds findWithoutFail($id, $columns = ['*'])
 * @method DeviceFeeds find($id, $columns = ['*'])
 * @method DeviceFeeds first($columns = ['*'])
*/
class DeviceFeedsRepository extends MyBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'humidity',
        'temperature',
        'device_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DeviceFeeds::class;
    }
}
