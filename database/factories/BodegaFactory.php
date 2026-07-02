<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sitio;

class BodegaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'sitio' => Sitio::inRandomOrder()->first()->id ?? 1,
            'nombre' => $this->faker->company() . ' Bodega',
        ];
    }
}