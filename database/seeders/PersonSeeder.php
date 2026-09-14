<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        Person::create([
            'rut' => '12345678-9',
            'nombres' => 'Ruddy',
            'apellido_paterno' => 'Mejia',
            'apellido_materno' => 'Mamani',
            'fecha_nacimiento' => '2001-01-19',
            'genero' => 'Masculino',
            'direccion' => 'Av. Siempre Viva 123',
            'ciudad' => 'Calama',
            'nacionalidad' => 'Boliviana',
            'estado_civil' => 'soltero',
            'email' => 'rmejiam.dev@gmail.com',
            'telefono' => '+56912345678',
            'cargo' => 'Desarrollador',
            'fecha_ingreso' => '2023-01-01',
            'empresa' => 'Empresa2',
            'sitio_id' => 1,
        ]);
        Person::factory(1000)->create();
    }
}