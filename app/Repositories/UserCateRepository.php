<?php

namespace App\Repositories;

use App\Models\UserCate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserCateRepository
 * @package App\Repositories
 * @version December 6, 2017, 9:36 am UTC
 *
 * @method UserCate findWithoutFail($id, $columns = ['*'])
 * @method UserCate find($id, $columns = ['*'])
 * @method UserCate first($columns = ['*'])
*/
class UserCateRepository extends BaseRepository
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
        return UserCate::class;
    }
}
