<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Adn;

class AdnSeeder extends Seeder
{
    public function run(): void
    {
        Adn::factory(6)->create();
    }
}