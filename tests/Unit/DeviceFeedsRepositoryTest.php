<?php

use App\Models\DeviceFeeds;
use App\Repositories\DeviceFeedsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeviceFeedsRepositoryTest extends TestCase
{
    use MakeDeviceFeedsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DeviceFeedsRepository
     */
    protected $deviceFeedsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->deviceFeedsRepo = App::make(DeviceFeedsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDeviceFeeds()
    {
        $deviceFeeds = $this->fakeDeviceFeedsData();
        $createdDeviceFeeds = $this->deviceFeedsRepo->create($deviceFeeds);
        $createdDeviceFeeds = $createdDeviceFeeds->toArray();
        $this->assertArrayHasKey('id', $createdDeviceFeeds);
        $this->assertNotNull($createdDeviceFeeds['id'], 'Created DeviceFeeds must have id specified');
        $this->assertNotNull(DeviceFeeds::find($createdDeviceFeeds['id']), 'DeviceFeeds with given id must be in DB');
        $this->assertModelData($deviceFeeds, $createdDeviceFeeds);
    }

    /**
     * @test read
     */
    public function testReadDeviceFeeds()
    {
        $deviceFeeds = $this->makeDeviceFeeds();
        $dbDeviceFeeds = $this->deviceFeedsRepo->find($deviceFeeds->id);
        $dbDeviceFeeds = $dbDeviceFeeds->toArray();
        $this->assertModelData($deviceFeeds->toArray(), $dbDeviceFeeds);
    }

    /**
     * @test update
     */
    public function testUpdateDeviceFeeds()
    {
        $deviceFeeds = $this->makeDeviceFeeds();
        $fakeDeviceFeeds = $this->fakeDeviceFeedsData();
        $updatedDeviceFeeds = $this->deviceFeedsRepo->update($fakeDeviceFeeds, $deviceFeeds->id);
        $this->assertModelData($fakeDeviceFeeds, $updatedDeviceFeeds->toArray());
        $dbDeviceFeeds = $this->deviceFeedsRepo->find($deviceFeeds->id);
        $this->assertModelData($fakeDeviceFeeds, $dbDeviceFeeds->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDeviceFeeds()
    {
        $deviceFeeds = $this->makeDeviceFeeds();
        $resp = $this->deviceFeedsRepo->delete($deviceFeeds->id);
        $this->assertTrue($resp);
        $this->assertNull(DeviceFeeds::find($deviceFeeds->id), 'DeviceFeeds should not exist in DB');
    }
}
