<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CdcFactory extends Factory
{
    public function definition(): array
    {
        $codigos = ['AB', 'AJ', 'CD', 'EF', 'GH', 'IJ', 'KL', 'MN', 'OP', 'QR', 'ST', 'UV', 'WX', 'YZ'];
        
        return [
            'cdc' => $this->faker->randomElement($codigos) . '-' . $this->faker->unique()->numberBetween(1, 9999),
            'descripcion' => $this->faker->sentence(3),
            'banco' => $this->faker->randomElement(['Banco de Chile', 'BCI', 'Santander', 'Itaú', 'Estado']),
            'tipo' => $this->faker->randomElement(['Operacional', 'Administrativo', 'Comercial', 'Logístico']),
        ];
    }
}