<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $hospitalId
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \App\Models\Hospital|null $hospital
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RoleUser[] $roleUsers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereHospitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable {

    use HasApiTokens,
        Notifiable;

    /**
     * Generated
     */
    protected $table = 'users';
    protected $fillable = ['id', 'name', 'email', 'username', 'password', 'remember_token', 'hospitalId'];

    /**
     * The attributes that should be hidden for arrays.
     * 
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hospital() {
        return $this->belongsTo(\App\Models\Hospital::class, 'hospitalId', 'id');
    }

    public function roles() {
        return $this->belongsToMany(\App\Models\Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function roleUsers() {
        return $this->hasMany(\App\Models\RoleUser::class, 'user_id', 'id');
    }

    public function patients() {
        return $this->hasMany(\App\Models\Patient::class);
    }

    public function pharmcies() {
        return $this->hasMany(\App\Models\Pharmcy::class);
    }

}
