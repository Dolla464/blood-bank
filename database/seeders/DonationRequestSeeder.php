<?php

namespace Database\Seeders;

use App\Models\DonationRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationRequestSeeder extends Seeder
{

    public function run(): void
    {
        DonationRequest::create([
            'patient_name' => 'Mohamed Ali',
            'patient_age' => 45,
            'blood_type_id' => 1,
            'bags_number' => 3,
            'hospital_name' => 'El Salam Hospital',
            'latitude' => 30.0444,
            'longitude' => 31.2357,
            'city_id' => 1,
            'patient_phone' => '01012345678',
            'notes' => 'Urgent case',
            'client_id' => 1,
        ]);
    }
}
