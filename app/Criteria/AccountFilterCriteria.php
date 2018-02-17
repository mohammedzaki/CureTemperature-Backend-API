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
class AccountFilterCriteria implements CriteriaInterface {

    private $accountId;

    public function __construct($accountId)
    {
        $this->accountId = $accountId;
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
            $model = $model->where('account_id', '=', $this->accountId);
        }

        return $model;
    }

}
