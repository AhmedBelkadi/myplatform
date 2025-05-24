<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Doe',
//            'prenom' => 'John',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'telephone' => '0123456789',
//            'ville' => 'Paris',
        ]);
    }
}
