<?php

namespace Database\Seeders;

use App\Models\Permission;
use Database\Factories\PermissionFactory;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        foreach (PermissionFactory::PERMISSIONS as $permission) {
            Permission::factory()->create([
                'name' => trans("permissions.$permission"),
                'slug' => $permission
            ]);
        }
    }
}
