<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $service)
    {
        $this->authService = $service;
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|exists:users',
            'password' => 'required'
        ]);
        $response = $this->authService->login($credentials);
        return response($response, Response::HTTP_CREATED);
    }

    public function destroy()
    {
        $this->authService->logout();
        return response([], Response::HTTP_NO_CONTENT);
    }
}
