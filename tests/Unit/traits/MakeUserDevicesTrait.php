<?php

use Faker\Factory as Faker;
use App\Models\UserDevices;
use App\Repositories\UserDevicesRepository;

trait MakeUserDevicesTrait
{
    /**
     * Create fake instance of UserDevices and save it in database
     *
     * @param array $userDevicesFields
     * @return UserDevices
     */
    public function makeUserDevices($userDevicesFields = [])
    {
        /** @var UserDevicesRepository $userDevicesRepo */
        $userDevicesRepo = App::make(UserDevicesRepository::class);
        $theme = $this->fakeUserDevicesData($userDevicesFields);
        return $userDevicesRepo->create($theme);
    }

    /**
     * Get fake instance of UserDevices
     *
     * @param array $userDevicesFields
     * @return UserDevices
     */
    public function fakeUserDevices($userDevicesFields = [])
    {
        return new UserDevices($this->fakeUserDevicesData($userDevicesFields));
    }

    /**
     * Get fake data of UserDevices
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUserDevicesData($userDevicesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'device_id' => $fake->randomDigitNotNull
        ], $userDevicesFields);
    }
}
