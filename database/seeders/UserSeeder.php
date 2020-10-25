<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $administratorRole = Role::firstOrNew(['slug' => 'administrator']);
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@picpay.com',
            'role_id' => $administratorRole
        ]);

        $shopkeeperRole = Role::firstOrNew(['slug' => 'shopkeeper']);
        User::factory()->count(10)->create(['role_id' => $shopkeeperRole]);

        $customerRole = Role::firstOrNew(['slug' => 'customer']);
        User::factory()->count(100)->create(['role_id' => $customerRole]);
    }
}
