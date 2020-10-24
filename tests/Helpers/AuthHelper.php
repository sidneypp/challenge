<?php

namespace Tests\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuthHelper
{
    private $headers = [];

    public function actingAs(User $user)
    {
        $token = Auth::guard()->fromUser($user);
        parent::actingAs($user);
        Auth::guard()->setToken($token);

        return $this;
    }
}
