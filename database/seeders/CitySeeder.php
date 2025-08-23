<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{

    public function run(): void
    {
        City::create(['name' => 'Cairo', 'governorate_id' => 1]);
        City::create(['name' => 'Alexandria', 'governorate_id' => 2]);
        City::create(['name' => 'Giza', 'governorate_id' => 1]);
    }
}
