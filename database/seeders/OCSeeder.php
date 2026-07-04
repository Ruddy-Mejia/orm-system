<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OC;
use App\Models\User;
use App\Models\Proveedores;
use App\Models\Adn;
use App\Models\Cdc;
use App\Models\FormaPago;
use App\Models\Convenio;
use App\Models\DetOrm;
use App\Models\Orm;

class OCSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() === 0) {
            User::factory(20)->create();
        }
        
        if (Proveedores::count() === 0) {
            Proveedores::factory(20)->create();
        }
        
        if (Adn::count() === 0) {
            Adn::factory(20)->create();
        }
        
        if (Cdc::count() === 0) {
            Cdc::factory(20)->create();
        }
        
        if (FormaPago::count() === 0) {
            FormaPago::factory(10)->create();
        }
        
        if (Convenio::count() === 0) {
            Convenio::factory(10)->create();
        }
        
        if (DetOrm::count() === 0) {
            DetOrm::factory(20)->create();
        }
        
        for ($i = 0; $i < 50; $i++) {
            OC::create([
                'oc' => Oc::generarNumeroOc(),
                'proveedor' => Proveedores::inRandomOrder()->first()->id,
                'forma_pago' => FormaPago::inRandomOrder()->first()->id,
                'convenio' => Convenio::inRandomOrder()->first()->id,
                'plazo_entrega' => fake()->numberBetween(1, 90),



                'det_orm' => json_encode(DetOrm::inRandomOrder()->first()->id),
                'orm' => Orm::inRandomOrder()->first()->orm,




                'monto_parcial' => $montoParcial = fake()->randomFloat(2, 1000, 100000),
                'monto_iva' => $montoParcial * 0.19,
                'monto_total' => $montoParcial * 1.19,
                'presupuesto' => fake()->optional(0.7)->randomFloat(2, 5000, 200000),
                'factura' => fake()->optional(0.6)->numerify('FAC-########'),
                'observacion' => fake()->optional(0.5)->text(200),
                'descuentos' => fake()->optional(0.4, 0)->randomFloat(2, 0, 5000),
                'impuestos' => fake()->optional(0.7, 0)->randomFloat(2, -1000, 5000),
                'status' => fake()->boolean(80),
                'cuotas' => fake()->numberBetween(1, 12),
                'terceros' => fake()->boolean(20),
                'path_factura' => fake()->optional(0.3)->url(),
                'path_pago' => fake()->optional(0.3)->url(),
                'autorizaciones' => json_encode([0, 0, 0]),
            ]);
        }
    }
}