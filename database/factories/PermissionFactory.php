<?php

namespace Database\Factories;

use App\Enumerators\TransactionPermission;
use App\Enumerators\UserPermission;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    public const PERMISSIONS = [
        UserPermission::USER_VIEW_ANY,
        UserPermission::USER_VIEW,
        UserPermission::USER_CREATE,
        UserPermission::USER_UPDATE,
        UserPermission::USER_DELETE,
        TransactionPermission::TRANSACTION_VIEW_ANY,
        TransactionPermission::TRANSACTION_VIEW,
        TransactionPermission::TRANSACTION_CREATE,
        TransactionPermission::TRANSACTION_UPDATE,
        TransactionPermission::TRANSACTION_DELETE
    ];

    protected $model = Permission::class;

    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle,
            'slug' => $this->faker->unique()->randomElement(self::PERMISSIONS),
            'description' => $this->faker->sentence
        ];
    }
}
