<?php

namespace Database\Seeders;

use App\Enumerators\TransactionPermission;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();
        $administrator = Role::factory()->create([
            'name' => 'Administrator',
            'slug' => 'administrator'
        ]);
        foreach ($permissions as $permission) {
            $administrator->permissions()->attach($permission);
        }

        $permissions = Permission::query()->whereIn('slug', [
            TransactionPermission::TRANSACTION_VIEW_ANY,
            TransactionPermission::TRANSACTION_VIEW
        ])->get();
        $shopkeeper = Role::factory()->create([
            'name' => 'Shopkeeper',
            'slug' => 'shopkeeper'
        ]);
        foreach ($permissions as $permission) {
            $shopkeeper->permissions()->attach($permission);
        }

        $permissions = Permission::whereIn('slug', [
            TransactionPermission::TRANSACTION_VIEW_ANY,
            TransactionPermission::TRANSACTION_VIEW,
            TransactionPermission::TRANSACTION_CREATE
        ])->get();
        $customer = Role::factory()->create([
            'name' => 'Customer',
            'slug' => 'customer'
        ]);
        foreach ($permissions as $permission) {
            $customer->permissions()->attach($permission);
        }
    }
}
