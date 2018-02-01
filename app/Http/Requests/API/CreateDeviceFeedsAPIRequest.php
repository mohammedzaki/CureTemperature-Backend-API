<?php

namespace App\Http\Requests\API;

use App\Models\DeviceFeeds;
use InfyOm\Generator\Request\APIRequest;

/**
 * Class CreateDeviceFeedsAPIRequest
 * @package App\Http\Requests\API
 * 
 * @property float $humidity
 * @property float $temperature
 * @property string $serial_number
 * @property int $channel_id
 * @property string $triggered_at
 * 
 */
class CreateDeviceFeedsAPIRequest extends APIRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return DeviceFeeds::$rulesAPI;
    }

}
