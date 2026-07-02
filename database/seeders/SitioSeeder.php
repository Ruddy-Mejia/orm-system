<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sitio;

class SitioSeeder extends Seeder
{
    public function run(): void
    {
        Sitio::factory(5)->create();
    }
}