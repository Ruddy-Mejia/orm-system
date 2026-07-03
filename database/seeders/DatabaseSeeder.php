<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ConvenioSeeder::class,
            FormaPagoSeeder::class,
            ProveedorSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CdcSeeder::class,
            AdnSeeder::class,
            SitioSeeder::class,
            CiudadSeeder::class,
            CategoriaSeeder::class,
            BodegaSeeder::class,
            ProductoSeeder::class,
            BodegaProductoSeeder::class,
            OrmSeeder::class,
            DetOrmSeeder::class,
            OCSeeder::class,
            MovimientoBodegaSeeder::class
        ]);
    }
}