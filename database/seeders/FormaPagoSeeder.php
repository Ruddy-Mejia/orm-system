<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormaPago;

class FormaPagoSeeder extends Seeder
{
    public function run(): void
    {
        // Formas de pago específicas
        $formasPago = [
            ['descripcion' => 'Contado', 'status' => true, 'autopago' => true],
            ['descripcion' => 'Crédito 30 días', 'status' => true, 'autopago' => false],
            ['descripcion' => 'Crédito 60 días', 'status' => true, 'autopago' => false],
            ['descripcion' => 'Tarjeta de Crédito', 'status' => true, 'autopago' => true],
            ['descripcion' => 'Transferencia Electrónica', 'status' => true, 'autopago' => true],
            ['descripcion' => 'Cheque al día', 'status' => true, 'autopago' => false],
            ['descripcion' => 'Cheque diferido', 'status' => false, 'autopago' => false],
            ['descripcion' => 'Pago en especie', 'status' => false, 'autopago' => false],
        ];
        
        foreach ($formasPago as $forma) {
            FormaPago::create($forma);
        }
        
        // Generar 5 formas de pago adicionales
        FormaPago::factory(5)->create();
    }
}