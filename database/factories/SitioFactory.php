<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SitioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->randomElement([
                'Oficina Central',
                'Planta Norte',
                'Planta Sur',
                'Centro de Distribución',
                'Mina El Tesoro',
                'Puerto de Embarque'
            ]),
            'status' => $this->faker->boolean(90),
        ];
    }
}