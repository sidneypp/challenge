<?php

namespace App\Services;

use App\Models\Wallet;
use App\Repositories\WalletRepository;

class WalletService
{
    private $repository;

    public function __construct(WalletRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findOrFail(int $id): Wallet
    {
        return $this->repository->findOrFail($id);
    }

    public function update(Wallet $wallet, array $attributes): void
    {
        $this->repository->update($wallet, $attributes);
    }
}
