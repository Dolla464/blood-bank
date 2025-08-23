<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    public function run(): void
    {
        Post::create([
            'title' => 'How to Stay Hydrated in Summer',
            'content' => 'Drink at least 2 liters of water daily...',
            'photo' => 'posts/summer_tips.jpg',
            'category_id' => 1
        ]);
    }
}
