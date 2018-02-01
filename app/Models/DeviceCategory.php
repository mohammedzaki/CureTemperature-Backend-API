<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\DeviceCategory
 *
 * @SWG\Definition (
 *      definition="DeviceCategory",
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
 *          property="min_temperature",
 *          description="min_temperature",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="max_temperature",
 *          description="max_temperature",
 *          type="number",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="alarm_times",
 *          description="alarm_times",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="alarm_frequency",
 *          description="alarm_frequency",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 * @property int $id
 * @property string $name
 * @property float $min_temperature
 * @property float $max_temperature
 * @property int|null $alarm_times
 * @property int|null $alarm_frequency
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Device[] $devices
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceCategory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereAlarmFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereAlarmTimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereMaxTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereMinTemperature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DeviceCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DeviceCategory withoutTrashed()
 * @mixin \Eloquent
 */
class DeviceCategory extends Model
{
    use SoftDeletes;

    public $table = 'device_category';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'min_temperature',
        'max_temperature',
        'alarm_times',
        'alarm_frequency'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'min_temperature' => 'float',
        'max_temperature' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function devices()
    {
        return $this->hasMany(\App\Models\Device::class);
    }
}
