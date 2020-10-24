<?php

namespace Tests\Helpers;

use App\Models\User;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

trait AuthHelper
{
    private $headers = [];

    public function authAs(User $user)
    {
        $token = JWTAuth::fromUser($user);
        $this->withHeader(['Authorization' => 'Bearer ' . $token]);

        return $this;
    }

    public function transformHeadersToServerVars(array $headers)
    {
        $server = [];
        $prefix = 'HTTP_';

        foreach (array_merge($headers, $this->headers) as $name => $value) {
            $name = strtr(strtoupper($name), '-', '_');

            if (!Str::startsWith($name, $prefix) && $name != 'CONTENT_TYPE') {
                $name = $prefix . $name;
            }

            $server[$name] = $value;
        }

        return $server;
    }

    protected function withHeader(array $headers)
    {
        $this->headers = $headers;
    }
}
