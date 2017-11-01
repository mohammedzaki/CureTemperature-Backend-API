<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Device",
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
 *          property="hospital",
 *          description="hospital",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="place",
 *          description="place",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="serial_number",
 *          description="serial_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="device_category_id",
 *          description="device_category_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Device extends Model
{
    use SoftDeletes;

    public $table = 'devices';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'hospital',
        'place',
        'serial_number',
        'device_category_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'hospital' => 'string',
        'place' => 'string',
        'serial_number' => 'string',
        'device_category_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function deviceCategory()
    {
        return $this->belongsTo(\App\Models\DeviceCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function deviceFeeds()
    {
        return $this->hasMany(\App\Models\DeviceFeed::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function userDevices()
    {
        return $this->hasMany(\App\Models\UserDevice::class);
    }
}
