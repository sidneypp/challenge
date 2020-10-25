<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function findOrFail(int $id): ?User
    {
        return $this->repository->findOrFail($id);
    }

    public function save(array $attributes): User
    {
        $user = $this->repository->create($attributes);
        $this->repository->save($user);
        return $user;
    }

    public function updateById(int $id, array $attributes): User
    {
        $user = $this->repository->findOrFail($id);
        $this->repository->update($user, $attributes);
        return $user;
    }

    public function deleteById(int $id): void
    {
        $this->repository->delete($id);
    }
}
