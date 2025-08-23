<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Example: create 5 dummy clients
        for ($i = 1; $i <= 5; $i++) {
            Client::create([
                'name' => 'Client ' . $i,
                'phone' => '010000000' . $i,
                'email' => 'client' . $i . '@example.com',
                'password' => Hash::make('123456'),
                'date_of_birth' => now()->subYears(20 + $i),
                'blood_type_id' => 1, // assuming 8 blood types exist
                'last_donation_date' => now()->subMonths(rand(1, 12)),
                'city_id' => 1, // assuming 10 cities exist
            ]);
        }
    }
}
