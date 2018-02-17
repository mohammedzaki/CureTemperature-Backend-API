<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Eloquent as Model;

/**
 * Class UserDevicesGetCriteriaCriteria.
 *
 * @package namespace App\Criteria;
 */
class CategoryFilterCriteria implements CriteriaInterface {

    private $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
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
        if ($model instanceof Model) {
            $model = $model->where('device_category_id', '=', $this->categoryId);
        }

        return $model;
    }

}
