<?php

namespace Tests\Helpers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class UserBuilder
{
    private $permission;

    public function withPermission(string $permission): UserBuilder
    {
        $this->permission = $permission;
        return $this;
    }

    public function build(): User
    {
        $permission = $this->permission
            ? Permission::factory(['slug' => $this->permission])
            : Permission::factory();
        $role = Role::factory()->has($permission);
        return User::factory()->create(['role_id' => $role]);
    }

    public static function make(): UserBuilder
    {
        return new self();
    }
}
