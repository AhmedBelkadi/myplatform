<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Administrateur')->first();
        $userRole = Role::where('name', 'Utilisateur')->first();
        $supportRole = Role::where('name', 'Support')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id
        ]);
        
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Support User $i",
                'email' => "support$i@example.com",
                'password' => Hash::make('password'),
                'role_id' => $supportRole->id
            ]);
        }
        
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Regular User $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('password'),
                'role_id' => $userRole->id
            ]);
        }
    }
}
