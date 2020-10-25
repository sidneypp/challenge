<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $administratorRole = Role::firstOrNew(['slug' => 'administrator']);
        User::factory()->has(Wallet::factory()->count(3))->create([
            'name' => 'Administrator',
            'email' => 'admin@picpay.com',
            'role_id' => $administratorRole
        ]);

        $shopkeeperRole = Role::firstOrNew(['slug' => 'shopkeeper']);
        User::factory()
            ->has(Wallet::factory()->count(1))
            ->count(10)
            ->create(['role_id' => $shopkeeperRole]);

        $customerRole = Role::firstOrNew(['slug' => 'customer']);
        User::factory()
            ->has(Wallet::factory()->count(2))
            ->count(100)
            ->create(['role_id' => $customerRole]);
    }
}
