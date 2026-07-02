<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Convenio;

class ConvenioSeeder extends Seeder
{
    public function run(): void
    {
        // Convenios específicos
        $convenios = [
            ['convenio' => 'Convenio Marco Ley 19.886', 'dia' => '30 días', 'status' => true],
            ['convenio' => 'Convenio Específico Ministerio', 'dia' => '45 días', 'status' => true],
            ['convenio' => 'Convenio Colaboración Público-Privada', 'dia' => '60 días', 'status' => true],
            ['convenio' => 'Convenio Simple', 'dia' => '15 días', 'status' => true],
            ['convenio' => 'Convenio Urgencia', 'dia' => '7 días', 'status' => false],
        ];
        
        foreach ($convenios as $convenio) {
            Convenio::create($convenio);
        }
        
        // Generar 10 convenios adicionales con factory
        Convenio::factory(10)->create();
    }
}