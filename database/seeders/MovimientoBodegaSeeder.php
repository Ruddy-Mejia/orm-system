<?php
// database/seeders/MovimientoBodegaSeeder.php

namespace Database\Seeders;

use App\Models\MovimientoBodega;
use Illuminate\Database\Seeder;

class MovimientoBodegaSeeder extends Seeder
{
    public function run(): void
    {
        // Crear movimientos aleatorios
        MovimientoBodega::factory(50)->create();
    }
}