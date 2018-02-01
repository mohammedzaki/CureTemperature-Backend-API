<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserCateApiTest extends TestCase
{
    use MakeUserCateTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateUserCate()
    {
        $userCate = $this->fakeUserCateData();
        $this->json('POST', '/api/v1/userCates', $userCate);

        $this->assertApiResponse($userCate);
    }

    /**
     * @test
     */
    public function testReadUserCate()
    {
        $userCate = $this->makeUserCate();
        $this->json('GET', '/api/v1/userCates/'.$userCate->id);

        $this->assertApiResponse($userCate->toArray());
    }

    /**
     * @test
     */
    public function testUpdateUserCate()
    {
        $userCate = $this->makeUserCate();
        $editedUserCate = $this->fakeUserCateData();

        $this->json('PUT', '/api/v1/userCates/'.$userCate->id, $editedUserCate);

        $this->assertApiResponse($editedUserCate);
    }

    /**
     * @test
     */
    public function testDeleteUserCate()
    {
        $userCate = $this->makeUserCate();
        $this->json('DELETE', '/api/v1/userCates/'.$userCate->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/userCates/'.$userCate->id);

        $this->assertResponseStatus(404);
    }
}
