<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement(['Administrador', 'Comprador', 'Solicitante', 'Jefe de Bodega', 'Perfil básico']),
        ];
    }
}