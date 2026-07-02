<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bodega;
use App\Models\Sitio;

class BodegaSeeder extends Seeder
{
    public function run(): void
    {
        $sitios = Sitio::all();
        
        foreach ($sitios as $sitio) {
            Bodega::create([
                'sitio' => $sitio->id,
                'nombre' => 'Bodega Principal ' . $sitio->descr_sitio,
            ]);
            
            Bodega::create([
                'sitio' => $sitio->id,
                'nombre' => 'Bodega Secundaria ' . $sitio->descr_sitio,
            ]);
        }
        
        // Bodegas adicionales con factory
        Bodega::factory(3)->create();
    }
}