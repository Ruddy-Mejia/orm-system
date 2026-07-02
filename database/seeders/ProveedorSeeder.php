<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedores;

class ProveedorSeeder extends Seeder
{
    public function run(): void
    {
        // Proveedores específicos
        $proveedores = [
            [
                'rut' => '760000001',
                'razon_social' => 'Empresa de Servicios Tecnológicos SA',
                'status' => true
            ],
            [
                'rut' => '765432101',
                'razon_social' => 'Construcciones y Montajes Ltda',
                'status' => true
            ],
            [
                'rut' => '769876543',
                'razon_social' => 'Suministros Industriales SpA',
                'status' => true
            ],
            [
                'rut' => '765432109',
                'razon_social' => 'Servicios de Alimentación SA',
                'status' => true
            ],
            [
                'rut' => '760123456',
                'razon_social' => 'Limpieza y Mantenimiento Ltda',
                'status' => false
            ],
            [
                'rut' => '777777777',
                'razon_social' => 'Distribuidora Eléctrica Metropolitana',
                'status' => true
            ],
            [
                'rut' => '788888888',
                'razon_social' => 'Papelería y Útiles de Oficina SA',
                'status' => true
            ],
            [
                'rut' => '799999999',
                'razon_social' => 'Transportes y Logística Rápida Ltda',
                'status' => false
            ],
        ];
        
        foreach ($proveedores as $Proveedores) {
            Proveedores::create($Proveedores);
        }
        
        // Generar 20 proveedores adicionales con factory
        Proveedores::factory(20)->create();
        
        // Generar 5 proveedores inactivos
        Proveedores::factory(5)->inactive()->create();
    }
}