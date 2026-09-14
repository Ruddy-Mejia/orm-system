<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SitioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->randomElement([
                'Sitio 32',
                'Sitio 3',
                'Sitio 35',
                'Sitio 39',
            ]),
            'status' => $this->faker->boolean(90),
        ];
    }
}