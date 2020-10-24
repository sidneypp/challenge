<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\Helpers\AuthHelper;
use Tests\TestCase;

class AuthFeatureTest extends TestCase
{
    use AuthHelper, DatabaseTransactions;

    const AUTH_END_POINT = 'auth';
    const DEFAULT_PASSWORD = '12345678';

    public function testShouldReturn201WhenAnAuthIsCreated()
    {
        $user = User::factory()->create(['password' => self::DEFAULT_PASSWORD]);
        $credentials = ['email' => $user->email, 'password' => self::DEFAULT_PASSWORD];
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
        $response = $this->authAs($user)->delete(self::AUTH_END_POINT);
        $response->assertResponseStatus(Response::HTTP_NO_CONTENT);
    }
}
