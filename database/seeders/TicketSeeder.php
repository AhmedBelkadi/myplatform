<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $users = User::whereHas('role', function($q) {
            $q->where('name', 'Utilisateur');
        })->get();
        
        $supportUsers = User::whereHas('role', function($q) {
            $q->where('name', 'Support');
        })->get();

        $statuses = ['open', 'resolved'];

        // Create tickets over the last 4 weeks
        for ($i = 0; $i < 100; $i++) {
            $randomDays = rand(0, 28); // Random day within last 4 weeks
            $createdAt = Carbon::now()->subDays($randomDays);
            
            $status = $statuses[array_rand($statuses)];
            $assignedTo = null;
            
            if ($status !== 'open') {
                $assignedTo = $supportUsers->random()->id;
            }

            Ticket::create([
                'title' => "Test Ticket #$i",
                'description' => "This is a test ticket description for ticket #$i",
                'status' => $status,
                'user_id' => $users->random()->id,
                'assigned_to' => $assignedTo,
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ]);
        }
    }
}
