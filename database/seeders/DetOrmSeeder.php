<?php

namespace Database\Seeders;

use App\Models\DetOrm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetOrmSeeder extends Seeder
{
    public function run(): void
    {
        DetOrm::factory(50)->create();
    }
}
