<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cdc;

class CdcSeeder extends Seeder
{
    public function run(): void
    {
        Cdc::factory(20)->create();
    }
}