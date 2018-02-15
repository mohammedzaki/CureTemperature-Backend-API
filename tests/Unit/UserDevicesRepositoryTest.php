<?php

use App\Models\UserDevices;
use App\Repositories\UserDevicesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserDevicesRepositoryTest extends TestCase
{
    use MakeUserDevicesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserDevicesRepository
     */
    protected $userDevicesRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userDevicesRepo = App::make(UserDevicesRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserDevices()
    {
        $userDevices = $this->fakeUserDevicesData();
        $createdUserDevices = $this->userDevicesRepo->create($userDevices);
        $createdUserDevices = $createdUserDevices->toArray();
        $this->assertArrayHasKey('id', $createdUserDevices);
        $this->assertNotNull($createdUserDevices['id'], 'Created UserDevices must have id specified');
        $this->assertNotNull(UserDevices::find($createdUserDevices['id']), 'UserDevices with given id must be in DB');
        $this->assertModelData($userDevices, $createdUserDevices);
    }

    /**
     * @test read
     */
    public function testReadUserDevices()
    {
        $userDevices = $this->makeUserDevices();
        $dbUserDevices = $this->userDevicesRepo->find($userDevices->id);
        $dbUserDevices = $dbUserDevices->toArray();
        $this->assertModelData($userDevices->toArray(), $dbUserDevices);
    }

    /**
     * @test update
     */
    public function testUpdateUserDevices()
    {
        $userDevices = $this->makeUserDevices();
        $fakeUserDevices = $this->fakeUserDevicesData();
        $updatedUserDevices = $this->userDevicesRepo->update($fakeUserDevices, $userDevices->id);
        $this->assertModelData($fakeUserDevices, $updatedUserDevices->toArray());
        $dbUserDevices = $this->userDevicesRepo->find($userDevices->id);
        $this->assertModelData($fakeUserDevices, $dbUserDevices->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserDevices()
    {
        $userDevices = $this->makeUserDevices();
        $resp = $this->userDevicesRepo->delete($userDevices->id);
        $this->assertTrue($resp);
        $this->assertNull(UserDevices::find($userDevices->id), 'UserDevices should not exist in DB');
    }
}
