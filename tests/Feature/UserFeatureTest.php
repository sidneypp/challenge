<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\Helpers\AuthHelper;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use AuthHelper, DatabaseTransactions;

    const USER_END_POINT = 'user';

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testShouldReturn200WhenListingUsers()
    {
        $response = $this->authAs($this->user)->get(self::USER_END_POINT);
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn200WhenShowingAUser()
    {
        $user = User::factory()->create();
        $response = $this->authAs($this->user)->get(self::USER_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn201WhenCreatingAUser()
    {
        $user = User::factory()->raw();
        $response = $this->authAs($this->user)->post(self::USER_END_POINT, $user);
        $response->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testShouldReturn200WhenEditingAUser()
    {
        $user = User::factory()->create();
        $response = $this->authAs($this->user)->put(self::USER_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn204WhenAUserIsDeleted()
    {
        $user = User::factory()->create();
        $response = $this->authAs($this->user)->delete(self::USER_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_NO_CONTENT);
    }
}
