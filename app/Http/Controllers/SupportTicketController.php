<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class SupportTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('user')
            ->where('assigned_to', auth()->id());

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Search by keyword (in title or description) or user name
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhereHas('user', function($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        $tickets = $query->latest()->paginate(10);
            
        return view('support.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        // // Ensure the support agent can only view their assigned tickets
        // if ($ticket->assigned_to !== auth()->id()) {
        //     abort(403, 'You are not authorized to view this ticket.');
        // }

        $ticket->load(['user', 'replies.user']);
        return view('support.tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        // Ensure the support agent can only reply to their assigned tickets
        if ($ticket->assigned_to !== auth()->id()) {
            abort(403, 'You are not authorized to reply to this ticket.');
        }

        $validated = $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $validated['message']
        ]);

        return redirect()->back()->with('success', 'Reply sent successfully');
    }

    public function resolve(Ticket $ticket)
    {
        // Ensure the support agent can only resolve their assigned tickets
        if ($ticket->assigned_to !== auth()->id()) {
            abort(403, 'You are not authorized to resolve this ticket.');
        }

        $ticket->update([
            'status' => 'resolved',
            'resolved_at' => now()
        ]);

        return redirect()->route('support.tickets.index')->with('success', 'Ticket marked as resolved');
    }
}
