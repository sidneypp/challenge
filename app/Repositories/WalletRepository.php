<?php

namespace App\Repositories;

use App\Models\Wallet;

class WalletRepository
{
    public function findOrFail(int $id): Wallet
    {
        return Wallet::findOrFail($id);
    }

    public function update(Wallet $wallet, array $attributes): void
    {
        $wallet->update($attributes);
    }
}
