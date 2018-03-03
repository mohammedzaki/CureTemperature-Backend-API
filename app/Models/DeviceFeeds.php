<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\DeviceFeeds
 *
 * @SWG\Definition (
 *      definition="DeviceFeeds",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="humidity",
 *          description="humidity",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="temperature",
 *          description="temperature",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="device_id",
 *          description="device_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="serial_number",
 *          description="device_serial_number",
 *          type="string"
 *      )
 * )
 * @property int $id
 * @property float $humidity
 * @property float $temperature
 * @property int $device_id
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Device|null $device
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceFeeds onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceFeeds whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceFeeds whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceFeeds whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceFeeds whereHumidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceFeeds whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceFeeds whereTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceFeeds whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceFeeds withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceFeeds withoutTrashed()
 * @mixin \Eloquent
 */
class DeviceFeeds extends Model
{
    //use SoftDeletes;

    public $table = 'device_feeds';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'humidity',
        'temperature',
        'device_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'humidity' => 'float',
        'temperature' => 'float',
        'device_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        "humidity" => "required",
        "temperature" => "required"
    ];
    
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rulesAPI = [
        'humidity' => 'required',
        'temperature' => 'required',
        //'serial_number' => 'required|exists:devices,serial_number'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function device()
    {
        return $this->belongsTo(\App\Models\Device::class);
    }
}
