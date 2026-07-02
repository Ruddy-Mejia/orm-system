<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FormaPago;

class FormaPagoFactory extends Factory
{
    protected $model = FormaPago::class;

    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->randomElement([
                'Contado', 'Crédito 30 días', 'Crédito 60 días', 
                'Tarjeta de Crédito', 'Transferencia', 'Cheque'
            ]),
            'status' => $this->faker->boolean(95),
            'autopago' => $this->faker->boolean(30),
        ];
    }
}