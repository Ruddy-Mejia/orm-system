<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition(): array
    {
        $rut = $this->faker->unique()->numberBetween(1000000, 25000000);
        return [
            'rut' => $this->generateRut($rut),
            'nombres' => $this->faker->firstName(),
            'apellido_paterno' => $this->faker->lastName(),
            'apellido_materno' => $this->faker->lastName(),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2005-01-01'),
            'genero' => $this->faker->randomElement(['Masculino', 'Femenino', 'Otro']),
            'direccion' => $this->faker->streetAddress(),
            'ciudad' => $this->faker->city(),
            'nacionalidad' => $this->faker->randomElement(['Boliviana', 'Chilena', 'Argentina', 'Peruana', 'Colombiana']),
            'estado_civil' => $this->faker->randomElement(['casado', 'soltero']),
            'email' => $this->faker->unique()->safeEmail(),
            'telefono' => $this->faker->phoneNumber(),
            'cargo' => $this->faker->jobTitle(),
            'fecha_ingreso' => $this->faker->date('Y-m-d', '2024-01-01'),
            'empresa' => $this->faker->randomElement(['Empresa1', 'Empresa2']),
            'sitio_id' => $this->faker->randomElement([1,2,3,4]),
        ];
    }

    private function generateRut($rut): string
    {
        $dv = $this->calculateDv($rut);
        return $rut . '-' . $dv;
    }

    private function calculateDv($rut): string
    {
        $sum = 0;
        $multiplier = 2;
        while ($rut > 0) {
            $sum += ($rut % 10) * $multiplier;
            $rut = intval($rut / 10);
            $multiplier++;
            if ($multiplier > 7) {
                $multiplier = 2;
            }
        }
        $dv = 11 - ($sum % 11);
        if ($dv == 11) return '0';
        if ($dv == 10) return 'K';
        return (string) $dv;
    }
}