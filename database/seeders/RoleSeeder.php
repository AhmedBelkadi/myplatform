<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'Administrateur']);
        Role::create(['name' => 'Support']);
        Role::create(['name' => 'Utilisateur']);
    }
} 