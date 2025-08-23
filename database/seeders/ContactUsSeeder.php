<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    
    public function run(): void
    {
         Contact::create([
        'subject' => 'Need help',
        'message' => 'How can I update my profile?',
        'client_id' => 1,
    ]);
    }
}
