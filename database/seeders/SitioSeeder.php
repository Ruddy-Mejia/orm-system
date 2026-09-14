<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sitio;

class SitioSeeder extends Seeder
{
    public function run(): void
    {
        $sitios = ['Sitio 32', 'Sitio 3', 'Sitio 35', 'Sitio 39'];

        foreach ($sitios as $sitio) {
            Sitio::firstOrCreate([
                'descripcion' => $sitio,
                'status' => true
            ]);
        }
    }
}