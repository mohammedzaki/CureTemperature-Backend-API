<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use App\Models\{
    Device,
    User,
    Role
};

/**
 * Class PreferedDevicesCriteria.
 *
 * @package namespace App\Criteria;
 */
class PreferedDevicesCriteria implements CriteriaInterface {

    private $devicesId;

    public function __construct(array $devicesId)
    {
        $this->devicesId = $devicesId;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if ($model instanceof Device) {
            $model = $model->whereIn('id', $this->devicesId);
        }

        return $model;
    }

}
