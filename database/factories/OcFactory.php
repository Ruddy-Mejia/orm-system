<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OC;
use App\Models\User;
use App\Models\Proveedores;
use App\Models\Adn;
use App\Models\Cdc;
use App\Models\FormaPago;
use App\Models\Convenio;
use App\Models\DetOrm;
class OCFactory extends Factory
{
    protected $model = OC::class;

    public function definition(): array
    {
        $year = $this->faker->numberBetween(2020, 2026);
        $sequential = $this->faker->unique()->numberBetween(1, 9999);

        $montoParcial = $this->faker->randomFloat(2, 1000, 100000);
        $iva = $montoParcial * 0.19;
        $montoTotal = $montoParcial + $iva;

        return [
            'oc' => Oc::generarNumeroOc(),
            'proveedor' => Proveedores::factory()->create()->id,
            'forma_pago' => FormaPago::factory()->create()->id,
            'convenio' => Convenio::factory()->create()->id,
            'plazo_entrega' => $this->faker->numberBetween(1, 90),
            'monto_parcial' => $montoParcial,
            'monto_iva' => $iva,
            'monto_total' => $montoTotal,
            'presupuesto' => $this->faker->optional(0.7, null)->randomFloat(2, 5000, 200000),
            'factura' => $this->faker->optional(0.6, null)->numerify('FAC-########'),
            'observacion' => $this->faker->optional(0.5, null)->text(200),
            'descuentos' => $this->faker->optional(0.4, 0)->randomFloat(2, 0, 5000),
            'impuestos' => $this->faker->optional(0.7, 0)->randomFloat(2, -1000, 5000),
            'status' => $this->faker->boolean(80),
            'cuotas' => $this->faker->numberBetween(1, 12),
            'terceros' => $this->faker->boolean(20),
            'path_factura' => $this->faker->optional(0.3, null)->url(),
            'path_pago' => $this->faker->optional(0.3, null)->url(),
            'autorizaciones' => json_encode([0, 0, 0]),
        ];
    }

    // Estado específico para OC con impuestos negativos
    public function withNegativeTaxes(): static
    {
        return $this->state(fn(array $attributes) => [
            'impuestos' => $this->faker->randomFloat(2, -1000, -1),
        ]);
    }

    // Estado específico para OC con terceros
    public function withThirdParties(): static
    {
        return $this->state(fn(array $attributes) => [
            'terceros' => true,
        ]);
    }

    // Estado específico para OC completada
    public function completed(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => true,
            'autorizaciones' => json_encode([1, 1, 1]),
        ]);
    }
}
