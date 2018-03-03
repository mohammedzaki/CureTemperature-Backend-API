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
 * Class UserDevicesNotificationsCriteria.
 *
 * @package namespace App\Criteria;
 */
class UserDevicesNotificationsCriteria implements CriteriaInterface {

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
            $deviceCategory = $model->deviceCategory;
            $userRole       = $this->user->roles->first();
            if (!empty($userRole) && $userRole->name != Role::MOBILE_APP_USER) {
                if ($userRole->name == Role::MOBILE_APP_ADMIN) {
                    $model = $model->where([
                        ['account_id', '=', $this->user->account_id],
                        ['alarm', '=', 1]
                    ]);
                } elseif ($userRole->name == Role::ADMIN || $userRole->name == Role::OWNER) {
                    $model = $model->where('alarm', '=', 1);
                }
            } else {
                $model = $model
                        ->leftJoin('user_devices', 'user_devices.device_id', '=', 'devices.id')
                        ->leftJoin('users', 'user_devices.user_id', '=', 'users.id')
                        ->distinct()
                        ->select('devices.*')
                        ->where([
                    ['users.id', '=', $this->user->id],
                    ['devices.alarm', '=', 1]
                ]);
            }
        }

        return $model;
    }

}
