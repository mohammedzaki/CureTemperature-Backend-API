<?php

use Faker\Factory as Faker;
use App\Models\DeviceCategory;
use App\Repositories\DeviceCategoryRepository;

trait MakeDeviceCategoryTrait
{
    /**
     * Create fake instance of DeviceCategory and save it in database
     *
     * @param array $deviceCategoryFields
     * @return DeviceCategory
     */
    public function makeDeviceCategory($deviceCategoryFields = [])
    {
        /** @var DeviceCategoryRepository $deviceCategoryRepo */
        $deviceCategoryRepo = App::make(DeviceCategoryRepository::class);
        $theme = $this->fakeDeviceCategoryData($deviceCategoryFields);
        return $deviceCategoryRepo->create($theme);
    }

    /**
     * Get fake instance of DeviceCategory
     *
     * @param array $deviceCategoryFields
     * @return DeviceCategory
     */
    public function fakeDeviceCategory($deviceCategoryFields = [])
    {
        return new DeviceCategory($this->fakeDeviceCategoryData($deviceCategoryFields));
    }

    /**
     * Get fake data of DeviceCategory
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDeviceCategoryData($deviceCategoryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'min_temperature' => $fake->randomDigitNotNull,
            'max_temperature' => $fake->randomDigitNotNull,
            'alarm_times' => $fake->word,
            'alarm_frequency' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $deviceCategoryFields);
    }
}
