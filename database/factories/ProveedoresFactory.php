<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proveedores;

class ProveedoresFactory extends Factory
{
    protected $model = Proveedores::class;

    public function definition(): array
    {
        // Generar RUT chileno válido
        $rutBody = $this->faker->numberBetween(1000000, 50000000);
        $dv = $this->calcularDigitoVerificador($rutBody);
        $rut = $rutBody . $dv;
        
        return [
            'rut' => $rut,
            'razon_social' => $this->faker->company() . ' ' . $this->faker->randomElement(['SpA', 'Ltda', 'SA', 'SRL']),
            'status' => $this->faker->boolean(90),
        ];
    }
    
    // Función para calcular dígito verificador del RUT chileno
    private function calcularDigitoVerificador($rut)
    {
        $sum = 0;
        $multiplier = 2;
        
        while ($rut != 0) {
            $sum += ($rut % 10) * $multiplier;
            $rut = floor($rut / 10);
            $multiplier = $multiplier < 7 ? $multiplier + 1 : 2;
        }
        
        $remainder = $sum % 11;
        $dv = 11 - $remainder;
        
        if ($dv == 11) return '0';
        if ($dv == 10) return 'K';
        return (string) $dv;
    }
    
    // Estado para proveedor inactivo
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => false,
        ]);
    }
}