<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDevicesApiTest extends TestCase
{
    use MakeUserDevicesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserDevices()
    {
        $userDevices = $this->fakeUserDevicesData();
        $this->json('POST', '/api/v1/userDevices', $userDevices);

        $this->assertApiResponse($userDevices);
    }

    /**
     * @test
     */
    public function testReadUserDevices()
    {
        $userDevices = $this->makeUserDevices();
        $this->json('GET', '/api/v1/userDevices/'.$userDevices->id);

        $this->assertApiResponse($userDevices->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserDevices()
    {
        $userDevices = $this->makeUserDevices();
        $editedUserDevices = $this->fakeUserDevicesData();

        $this->json('PUT', '/api/v1/userDevices/'.$userDevices->id, $editedUserDevices);

        $this->assertApiResponse($editedUserDevices);
    }

    /**
     * @test
     */
    public function testDeleteUserDevices()
    {
        $userDevices = $this->makeUserDevices();
        $this->json('DELETE', '/api/v1/userDevices/'.$userDevices->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/userDevices/'.$userDevices->id);

        $this->assertResponseStatus(404);
    }
}
