<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cpf' => $this->faker->cpf,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '12345678',
            'role_id' => Role::factory()
        ];
    }
}
