<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="UserCate",
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
 */
class UserCate extends Model
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
