<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeviceCategoryApiTest extends TestCase
{
    use MakeDeviceCategoryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDeviceCategory()
    {
        $deviceCategory = $this->fakeDeviceCategoryData();
        $this->json('POST', '/api/v1/deviceCategories', $deviceCategory);

        $this->assertApiResponse($deviceCategory);
    }

    /**
     * @test
     */
    public function testReadDeviceCategory()
    {
        $deviceCategory = $this->makeDeviceCategory();
        $this->json('GET', '/api/v1/deviceCategories/'.$deviceCategory->id);

        $this->assertApiResponse($deviceCategory->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDeviceCategory()
    {
        $deviceCategory = $this->makeDeviceCategory();
        $editedDeviceCategory = $this->fakeDeviceCategoryData();

        $this->json('PUT', '/api/v1/deviceCategories/'.$deviceCategory->id, $editedDeviceCategory);

        $this->assertApiResponse($editedDeviceCategory);
    }

    /**
     * @test
     */
    public function testDeleteDeviceCategory()
    {
        $deviceCategory = $this->makeDeviceCategory();
        $this->json('DELETE', '/api/v1/deviceCategories/'.$deviceCategory->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/deviceCategories/'.$deviceCategory->id);

        $this->assertResponseStatus(404);
    }
}
