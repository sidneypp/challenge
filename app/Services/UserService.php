<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->userRepository->all();
    }

    public function findOrFail(int $id): ?User
    {
        return $this->userRepository->findOrFail($id);
    }

    public function save(array $attributes): User
    {
        $user = $this->userRepository->create($attributes);
        $this->userRepository->save($user);
        return $user;
    }

    public function updateById(int $id, array $attributes): User
    {
        $user = $this->userRepository->findOrFail($id);
        $this->userRepository->update($user, $attributes);
        return $user;
    }

    public function deleteById(int $id): void
    {
        $this->userRepository->delete($id);
    }
}
