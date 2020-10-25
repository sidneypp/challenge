<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\Helpers\AuthHelper;
use Tests\TestCase;

class AuthFeatureTest extends TestCase
{
    use AuthHelper, DatabaseMigrations;

    const AUTH_END_POINT = 'auth';

    public function testShouldReturn201WhenAnAuthIsCreated()
    {
        $user = User::factory()->create();
        $credentials = ['email' => $user->email, 'password' => '12345678'];
        $response = $this->post(self::AUTH_END_POINT, $credentials);
        $response->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testShouldReturn401WhenThePasswordIsIncorrect()
    {
        $user = User::factory()->create();
        $credentials = ['email' => $user->email, 'password' => 'Incorrect password'];
        $response = $this->post(self::AUTH_END_POINT, $credentials);
        $response->assertResponseStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function testShouldReturn204WhenAnAuthIsDeleted()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(self::AUTH_END_POINT);
        $response->assertResponseStatus(Response::HTTP_NO_CONTENT);
    }
}
