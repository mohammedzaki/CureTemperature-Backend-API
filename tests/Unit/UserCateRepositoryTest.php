<?php

use App\Models\UserCate;
use App\Repositories\UserCateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCateRepositoryTest extends TestCase
{
    use MakeUserCateTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var UserCateRepository
     */
    protected $userCateRepo;

    public function setUp()
    {
        parent::setUp();
        $this->userCateRepo = App::make(UserCateRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateUserCate()
    {
        $userCate = $this->fakeUserCateData();
        $createdUserCate = $this->userCateRepo->create($userCate);
        $createdUserCate = $createdUserCate->toArray();
        $this->assertArrayHasKey('id', $createdUserCate);
        $this->assertNotNull($createdUserCate['id'], 'Created UserCate must have id specified');
        $this->assertNotNull(UserCate::find($createdUserCate['id']), 'UserCate with given id must be in DB');
        $this->assertModelData($userCate, $createdUserCate);
    }

    /**
     * @test read
     */
    public function testReadUserCate()
    {
        $userCate = $this->makeUserCate();
        $dbUserCate = $this->userCateRepo->find($userCate->id);
        $dbUserCate = $dbUserCate->toArray();
        $this->assertModelData($userCate->toArray(), $dbUserCate);
    }

    /**
     * @test update
     */
    public function testUpdateUserCate()
    {
        $userCate = $this->makeUserCate();
        $fakeUserCate = $this->fakeUserCateData();
        $updatedUserCate = $this->userCateRepo->update($fakeUserCate, $userCate->id);
        $this->assertModelData($fakeUserCate, $updatedUserCate->toArray());
        $dbUserCate = $this->userCateRepo->find($userCate->id);
        $this->assertModelData($fakeUserCate, $dbUserCate->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteUserCate()
    {
        $userCate = $this->makeUserCate();
        $resp = $this->userCateRepo->delete($userCate->id);
        $this->assertTrue($resp);
        $this->assertNull(UserCate::find($userCate->id), 'UserCate should not exist in DB');
    }
}
