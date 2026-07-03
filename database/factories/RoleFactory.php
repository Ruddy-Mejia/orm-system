<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->randomElement(['Administrador', 'Comprador', 'Solicitante', 'Jefe de Bodega', 'Perfil básico']),
            'guard_name' => $this->faker->randomElement(['admin', 'comprador', 'solicitante', 'jefe_bodega','perfil_basico']),
        ];
    }
}