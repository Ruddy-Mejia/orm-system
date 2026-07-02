<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Orm;

class OrmSeeder extends Seeder
{
    public function run(): void
    {
        Orm::factory(30)->create();
    }
}