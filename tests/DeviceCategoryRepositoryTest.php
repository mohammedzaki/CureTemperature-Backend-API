<?php

use App\Models\DeviceCategory;
use App\Repositories\DeviceCategoryRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeviceCategoryRepositoryTest extends TestCase
{
    use MakeDeviceCategoryTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DeviceCategoryRepository
     */
    protected $deviceCategoryRepo;

    public function setUp()
    {
        parent::setUp();
        $this->deviceCategoryRepo = App::make(DeviceCategoryRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDeviceCategory()
    {
        $deviceCategory = $this->fakeDeviceCategoryData();
        $createdDeviceCategory = $this->deviceCategoryRepo->create($deviceCategory);
        $createdDeviceCategory = $createdDeviceCategory->toArray();
        $this->assertArrayHasKey('id', $createdDeviceCategory);
        $this->assertNotNull($createdDeviceCategory['id'], 'Created DeviceCategory must have id specified');
        $this->assertNotNull(DeviceCategory::find($createdDeviceCategory['id']), 'DeviceCategory with given id must be in DB');
        $this->assertModelData($deviceCategory, $createdDeviceCategory);
    }

    /**
     * @test read
     */
    public function testReadDeviceCategory()
    {
        $deviceCategory = $this->makeDeviceCategory();
        $dbDeviceCategory = $this->deviceCategoryRepo->find($deviceCategory->id);
        $dbDeviceCategory = $dbDeviceCategory->toArray();
        $this->assertModelData($deviceCategory->toArray(), $dbDeviceCategory);
    }

    /**
     * @test update
     */
    public function testUpdateDeviceCategory()
    {
        $deviceCategory = $this->makeDeviceCategory();
        $fakeDeviceCategory = $this->fakeDeviceCategoryData();
        $updatedDeviceCategory = $this->deviceCategoryRepo->update($fakeDeviceCategory, $deviceCategory->id);
        $this->assertModelData($fakeDeviceCategory, $updatedDeviceCategory->toArray());
        $dbDeviceCategory = $this->deviceCategoryRepo->find($deviceCategory->id);
        $this->assertModelData($fakeDeviceCategory, $dbDeviceCategory->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDeviceCategory()
    {
        $deviceCategory = $this->makeDeviceCategory();
        $resp = $this->deviceCategoryRepo->delete($deviceCategory->id);
        $this->assertTrue($resp);
        $this->assertNull(DeviceCategory::find($deviceCategory->id), 'DeviceCategory should not exist in DB');
    }
}
