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
 * Class UserDevicesCriteria.
 *
 * @package namespace App\Criteria;
 */
class UserDevicesCriteria implements CriteriaInterface {

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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
            $userRole = $this->user->roles->first();
            if (!empty($userRole) && $userRole->name == Role::MOBILE_APP_ADMIN) {
                $model = $model->where('account_id', '=', $this->user->account_id);
            } else {
                $model = $model
                        ->leftJoin('user_devices', 'user_devices.device_id', '=', 'devices.id')
                        ->leftJoin('users', 'user_devices.user_id', '=', 'users.id')
                        ->distinct()
                        ->select('devices.*')
                        ->where('users.id', '=', $this->user->id);
            }
        }

        return $model;
    }

}
