<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserFactory extends Factory
{
    protected $model = \App\Models\User::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'status' => $this->faker->boolean(80),
            'rol' => Role::inRandomOrder()->first()->id,
            'foto_perfil' => null,
            'firma' => null,
            'remember_token' => $this->faker->uuid(),
        ];
    }
}