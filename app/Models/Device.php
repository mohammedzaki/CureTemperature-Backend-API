<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Device
 *
 * @SWG\Definition (
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
 *          property="serial_number",
 *          description="serial_number",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="temp",
 *          description="temp",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="percentage",
 *          description="percentage",
 *          type="integer"
 *      ),
 *      @SWG\Property(
 *          property="alarm",
 *          description="alarm",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="reverse",
 *          description="reverse",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="device_category_id",
 *          description="device_category_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 * @property int $id
 * @property string $name
 * @property string $hospital
 * @property string $place
 * @property string $serial_number
 * @property int $device_category_id
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at 
 * @property-read \App\Models\DeviceCategory|null $deviceCategory
 * @property-read \App\Models\Account|null $deviceAccount
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DeviceFeeds[] $deviceFeeds
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserDevice[] $userDevices
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Device onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device whereDeviceCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device whereHospital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Device withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Device withoutTrashed()
 * @mixin \Eloquent
 */
class Device extends Model {

    use SoftDeletes;

    public $table = 'devices';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];
    public $fillable = [
        'name',
        'serial_number',
        'description',
        'temp',
        'percentage',
        'reverse',
        'alarm',
        'device_category_id',
        'account_id'
    ];
    public $position = '';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                 => 'integer',
        'name'               => 'string',
        'serial_number'      => 'string',
        'device_category_id' => 'integer',
        'account_id'         => 'integer'
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
     * */
    public function deviceCategory()
    {
        return $this->belongsTo(\App\Models\DeviceCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * */
    public function deviceAccount()
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * */
    public function deviceFeeds()
    {
        return $this->hasMany(\App\Models\DeviceFeeds::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * */
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_devices');
    }

}
