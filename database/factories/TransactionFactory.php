<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'payer' => Wallet::factory(),
            'payee' => Wallet::factory(),
            'value' => $this->faker->randomFloat()
        ];
    }
}
