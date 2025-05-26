<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketReply;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            TicketSeeder::class,
            ReplySeeder::class,
        ]);
    }
    
}

