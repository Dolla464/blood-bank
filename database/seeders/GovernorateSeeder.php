<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{

    public function run(): void
    {
        $governorates = [
            'Cairo',
            'Giza',
            'Alexandria',
            'Aswan',
            'Assiut',
            'Beheira',
            'Beni Suef',
            'Dakahlia',
            'Damietta',
            'Fayoum',
            'Gharbia',
            'Ismailia',
            'Kafr El Sheikh',
            'Luxor',
            'Matrouh',
            'Minya',
            'Monufia',
            'New Valley',
            'North Sinai',
            'Port Said',
            'Qalyubia',
            'Qena',
            'Red Sea',
            'Sharqia',
            'Sohag',
            'South Sinai',
            'Suez'
        ];

        foreach ($governorates as $name) {
            Governorate::create(['name' => $name]);
        }
    }
}
