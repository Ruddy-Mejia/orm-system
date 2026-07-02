<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Convenio;

class ConvenioFactory extends Factory
{
    protected $model = Convenio::class;

    public function definition(): array
    {
        return [
            'convenio' => $this->faker->company() . ' ' . $this->faker->randomElement(['SA', 'SRL', 'Ltda']),
            'dia' => $this->faker->randomElement(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', '15 días', '30 días', '60 días']),
            'status' => $this->faker->boolean(90),
        ];
    }
}