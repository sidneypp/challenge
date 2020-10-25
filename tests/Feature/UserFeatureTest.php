<?php

namespace Tests\Feature;

use App\Enumerators\UserPermission;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\Helpers\AuthHelper;
use Tests\Helpers\UserBuilder;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use AuthHelper, DatabaseMigrations;

    const USER_END_POINT = 'user';

    public function testShouldReturn200WhenListingUsers()
    {
        $user = UserBuilder::make()
            ->withPermission(UserPermission::USER_VIEW_ANY)
            ->build();
        $response = $this->actingAs($user)->get(self::USER_END_POINT);
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn200WhenShowingAUser()
    {
        $user = UserBuilder::make()
            ->withPermission(UserPermission::USER_VIEW)
            ->build();
        $response = $this->actingAs($user)->get(self::USER_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn201WhenCreatingAUser()
    {
        $user = UserBuilder::make()
            ->withPermission(UserPermission::USER_CREATE)
            ->build();
        $userToCreate = User::factory()->raw();
        $response = $this->actingAs($user)->post(self::USER_END_POINT, $userToCreate);
        $response->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testShouldReturn200WhenEditingAUser()
    {
        $user = UserBuilder::make()
            ->withPermission(UserPermission::USER_UPDATE)
            ->build();
        $response = $this->actingAs($user)->put(self::USER_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn204WhenAUserIsDeleted()
    {
        $user = UserBuilder::make()
            ->withPermission(UserPermission::USER_DELETE)
            ->build();
        $response = $this->actingAs($user)->delete(self::USER_END_POINT . "/$user->id");
        $response->assertResponseStatus(Response::HTTP_NO_CONTENT);
    }
}
