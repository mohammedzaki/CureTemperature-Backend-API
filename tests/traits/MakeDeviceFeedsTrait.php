<?php

use Faker\Factory as Faker;
use App\Models\DeviceFeeds;
use App\Repositories\DeviceFeedsRepository;

trait MakeDeviceFeedsTrait
{
    /**
     * Create fake instance of DeviceFeeds and save it in database
     *
     * @param array $deviceFeedsFields
     * @return DeviceFeeds
     */
    public function makeDeviceFeeds($deviceFeedsFields = [])
    {
        /** @var DeviceFeedsRepository $deviceFeedsRepo */
        $deviceFeedsRepo = App::make(DeviceFeedsRepository::class);
        $theme = $this->fakeDeviceFeedsData($deviceFeedsFields);
        return $deviceFeedsRepo->create($theme);
    }

    /**
     * Get fake instance of DeviceFeeds
     *
     * @param array $deviceFeedsFields
     * @return DeviceFeeds
     */
    public function fakeDeviceFeeds($deviceFeedsFields = [])
    {
        return new DeviceFeeds($this->fakeDeviceFeedsData($deviceFeedsFields));
    }

    /**
     * Get fake data of DeviceFeeds
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDeviceFeedsData($deviceFeedsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'humidity' => $fake->randomDigitNotNull,
            'temperature' => $fake->randomDigitNotNull,
            'device_id' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $deviceFeedsFields);
    }
}
