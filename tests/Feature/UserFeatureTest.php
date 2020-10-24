<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use DatabaseMigrations;

    const USERS_END_POINT = 'user';

    public function testShouldReturn200WhenListingUsers()
    {
        $response = $this->get(self::USERS_END_POINT);
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn200WhenShowingAUser()
    {
        $user = User::factory()->create();
        $response = $this->get(self::USERS_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn201WhenCreatingAUser()
    {
        $user = User::factory()->raw();
        $response = $this->post(self::USERS_END_POINT, $user);
        $response->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testShouldReturn200WhenEditingAUser()
    {
        $user = User::factory()->create();
        $response = $this->put(self::USERS_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn204WhenAUserIsDeleted()
    {
        $user = User::factory()->create();
        $response = $this->delete(self::USERS_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_NO_CONTENT);
    }
}
