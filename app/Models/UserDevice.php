<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="UserDevices",
 *      required={""},
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="device_id",
 *          description="device_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class UserDevice extends Model {

    public $table = 'user_devices';
    public $timestamps = false;
    public $fillable = [
        'id',
        'device_id',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'device_id' => 'integer',
        'user_id'   => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id'   => 'required',
        'device_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * */
    public function device()
    {
        return $this->belongsTo(\App\Models\Device::class, 'device_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

}
