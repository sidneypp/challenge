<?php

namespace App\Http\Controllers;

use App\Enumerators\UserPermission;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function index()
    {
        $this->authorize(UserPermission::USER_VIEW_ANY);
        $users = $this->userService->getAll();
        return response($users);
    }

    public function show(int $id)
    {
        $this->authorize(UserPermission::USER_VIEW);
        $user = $this->userService->findOrFail($id);
        return response($user);
    }

    public function store(Request $request)
    {
        $this->authorize(UserPermission::USER_CREATE);
        $validatedData = $this->validate($request, [
            'name' => 'required|string|max:255',
            'cpf' => 'required|cpf|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id,deleted_at,NULL'
        ]);
        $user = $this->userService->save($validatedData);
        return response($user, Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id)
    {
        $this->authorize(UserPermission::USER_UPDATE);
        $validatedData = $this->validate($request, [
            'name' => 'sometimes|string|max:255',
            'cpf' => 'sometimes|cpf|unique:users',
            'email' => 'sometimes|email|unique:users',
            'password' => 'sometimes|min:8',
            'role_id' => 'sometimes|exists:roles,id,deleted_at,NULL'
        ]);
        $user = $this->userService->updateById($id, $validatedData);
        return response($user);
    }

    public function destroy(int $id)
    {
        $this->authorize(UserPermission::USER_DELETE);
        $this->userService->deleteById($id);
        return response([], Response::HTTP_NO_CONTENT);
    }
}
