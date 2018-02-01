<?php

use Faker\Factory as Faker;
use App\Models\UserCate;
use App\Repositories\UserCateRepository;

trait MakeUserCateTrait
{
    /**
     * Create fake instance of UserCate and save it in database
     *
     * @param array $userCateFields
     * @return UserCate
     */
    public function makeUserCate($userCateFields = [])
    {
        /** @var UserCateRepository $userCateRepo */
        $userCateRepo = App::make(UserCateRepository::class);
        $theme = $this->fakeUserCateData($userCateFields);
        return $userCateRepo->create($theme);
    }

    /**
     * Get fake instance of UserCate
     *
     * @param array $userCateFields
     * @return UserCate
     */
    public function fakeUserCate($userCateFields = [])
    {
        return new UserCate($this->fakeUserCateData($userCateFields));
    }

    /**
     * Get fake data of UserCate
     *
     * @param array $postFields
     * @return array
     */
    public function fakeUserCateData($userCateFields = [])
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
        ], $userCateFields);
    }
}
