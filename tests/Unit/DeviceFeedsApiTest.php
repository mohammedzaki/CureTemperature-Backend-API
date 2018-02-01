<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeviceFeedsApiTest extends TestCase
{
    use MakeDeviceFeedsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDeviceFeeds()
    {
        $deviceFeeds = $this->fakeDeviceFeedsData();
        $this->json('POST', '/api/v1/deviceFeeds', $deviceFeeds);

        $this->assertApiResponse($deviceFeeds);
    }

    /**
     * @test
     */
    public function testReadDeviceFeeds()
    {
        $deviceFeeds = $this->makeDeviceFeeds();
        $this->json('GET', '/api/v1/deviceFeeds/'.$deviceFeeds->id);

        $this->assertApiResponse($deviceFeeds->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDeviceFeeds()
    {
        $deviceFeeds = $this->makeDeviceFeeds();
        $editedDeviceFeeds = $this->fakeDeviceFeedsData();

        $this->json('PUT', '/api/v1/deviceFeeds/'.$deviceFeeds->id, $editedDeviceFeeds);

        $this->assertApiResponse($editedDeviceFeeds);
    }

    /**
     * @test
     */
    public function testDeleteDeviceFeeds()
    {
        $deviceFeeds = $this->makeDeviceFeeds();
        $this->json('DELETE', '/api/v1/deviceFeeds/'.$deviceFeeds->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/deviceFeeds/'.$deviceFeeds->id);

        $this->assertResponseStatus(404);
    }
}
