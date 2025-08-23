<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{

    public function run(): void
    {
        Notification::create([
            'title' => 'Urgent Blood Needed',
            'message' => 'We need O+ blood in Cairo hospital ASAP.',
            'donation_request_id' => '1'
        ]);
    }
}
