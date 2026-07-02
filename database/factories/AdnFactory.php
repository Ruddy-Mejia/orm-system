<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdnFactory extends Factory
{
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->randomElement([
                'Logística y Transporte',
                'Administración y Finanzas',
                'Operaciones Mineras',
                'Mantenimiento Industrial',
                'Recursos Humanos',
                'Tecnología de la Información'
            ]),
            'tipo' => $this->faker->randomElement(['Interno', 'Externo', 'Mixto']),
        ];
    }
}