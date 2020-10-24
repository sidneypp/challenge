<?php

namespace App\Services;

use App\Exceptions\AuthExceptions;

class AuthService
{
    public function login(array $credentials): array
    {
        $token = auth()->attempt($credentials);
        if ($token) {
            return $this->formatLoginResponse($token);
        }
        throw AuthExceptions::unauthorized();
    }

    public function logout(): void
    {
        auth()->logout();
    }

    private function formatLoginResponse($token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
