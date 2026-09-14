<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Orm;
use App\Models\DetOrm;

class OrmSeeder extends Seeder
{
    public function run(): void
    {
        Orm::factory(1000)
            ->has(DetOrm::factory(3), 'detOrmRel') // Crear 3 registros de DetOrm para cada Orm
            ->create();
    }
}