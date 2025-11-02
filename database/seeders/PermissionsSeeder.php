<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->delete();
        
        // Create admin role
        $adminRole = Role::updateOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);
        
        // Create user role
        $userRole = Role::updateOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);
        $permissions = [
            // Users
            'Users' =>[
                'create users',
                'read users',
                'update users',
                'delete users',
            ],

            // Roles
            'Roles' =>[
                'create roles',
                'read roles',
                'update roles',
                'delete roles',
            ],

            // Governorates
            'Governorates' =>[
                'create governorates',
                'read governorates',
                'update governorates',
                'delete governorates',
            ],

            // Cities
            'Cities' =>[
                'create cities',
                'read cities',
                'update cities',
                'delete cities',
            ],

            // Categories
            'Categories' =>[
                'create categories',
                'read categories',
                'update categories',
                'delete categories',
            ],

            // Clients
            'Clients' =>[
                'create clients',
                'read clients',
                'update clients',
                'delete clients',
            ],

            // Posts
            'Posts' =>[ 
                'create posts',
                'read posts',
                'update posts',
                'delete posts',
            ],
            // Donations
            'Donations' =>[
                'read donations',
                'delete donations',
            ],

            // Messages
            'Messages' =>[
                'read messages',
                'delete messages',
            ],
        ];

        foreach ($permissions as $group => $permissionList) {
            foreach ($permissionList as $permissionName) {
                $permission = Permission::updateOrCreate([
                    'name' => $permissionName,
                    'guard_name' => 'web',
                    'group' => $group,
                ]);
                $adminRole->givePermissionTo($permission);
            }
        }
    }
}
