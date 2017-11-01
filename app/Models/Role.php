<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

/**
 * @SWG\Definition(
 *      definition="Role",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="display_name",
 *          description="display_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      )
 * )
 */
class Role extends EntrustRole {

    public $table = 'roles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'name',
        'display_name',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'name'         => 'string',
        'display_name' => 'string',
        'description'  => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * */
    public function permissions() {
        return $this->belongsToMany(\App\Models\Permission::class, 'permission_role');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * */
    public function users() {
        return $this->belongsToMany(\App\Models\User::class, 'role_user');
    }

}
