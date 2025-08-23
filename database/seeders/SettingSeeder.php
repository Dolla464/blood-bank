<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    public function run(): void
    {
        Settings::create([
            'phone' => '01000000000',
            'email' => 'support@bloodbank.com',
            'fb_url' => 'https://facebook.com/bloodbank',
            'x_url' => 'https://x.com/bloodbank',
            'insta_url' => 'https://instagram.com/bloodbank',
            'youtube_url' => 'https://youtube.com/bloodbank',
            'about_app' => 'This is a blood donation management app designed to save lives.',
        ]);
    }
}
