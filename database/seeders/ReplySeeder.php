<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Carbon\Carbon;

class ReplySeeder extends Seeder
{
    public function run(): void
    {
        $tickets = Ticket::all();
        $supportUsers = User::whereHas('role', function($q) {
            $q->where('name', 'Support');
        })->get();

        foreach ($tickets as $ticket) {
            // Skip some tickets to have variety
            if (rand(0, 1) === 0) {
                continue;
            }

            $repliesCount = rand(1, 5); // Random number of replies per ticket
            
            for ($i = 0; $i < $repliesCount; $i++) {
                $createdAt = Carbon::parse($ticket->created_at)->addHours(rand(1, 48));
                
                // Alternate between support and ticket creator for replies
                $user = $i % 2 === 0 ? $supportUsers->random() : $ticket->user;

                TicketReply::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user->id,
                    'message' => "This is reply #$i for ticket #{$ticket->id}",
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt
                ]);
            }
        }
    }
}
