<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => 'password123', 
        ]);
        
        // Create regular user
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => 'password123', 
        ]);
        
        // Assign roles
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        
        if ($adminRole) {
            $admin->assignRole($adminRole);
        }
        
        if ($userRole) {
            $user->assignRole($userRole);
        }
    }
}
