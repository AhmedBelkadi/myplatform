<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création d'un utilisateur avec des informations complètes
        User::create([
            'name' => 'Test User',
//            'prenom' => 'John',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),  // Assurez-vous que le mot de passe est crypté
//            'telephone' => '0123456789',
//            'ville' => 'Paris',
        ]);
    }
}
