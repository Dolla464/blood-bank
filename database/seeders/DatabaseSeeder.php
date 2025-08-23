<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BloodTypeSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(GovernorateSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(DonationRequestSeeder::class);
        $this->call(NotificationSeeder::class);

    }
}
