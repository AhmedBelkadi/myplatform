<?php

namespace App\Http\Controllers\Utilisateur;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Ticket::where('user_id', auth()->id());

        // Apply status filter
        if (request()->has('status') && request('status') !== '') {
            $query->where('status', request('status'));
        }

        // Apply search filter
        if (request()->has('search') && request('search') !== '') {
            $search = request('search');
            $query->where('title', 'like', "%{$search}%");
        }

        $tickets = $query->latest()->paginate(10)->withQueryString();
        return view('regular-user.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('regular-user.tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'status' => 'open'
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket créé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        // Ensure the user can only view their own tickets
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        $ticket->load(['assignedSupport', 'replies.user']);
        return view('regular-user.tickets.show', compact('ticket'));
    }

    /**
     * Add a reply to the ticket.
     */
    public function reply(Request $request, Ticket $ticket)
    {
        // Ensure the user can only reply to their own tickets
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        // Validate the request
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Create the reply
        $ticket->replies()->create([
            'user_id' => auth()->id(),
            'message' => $validated['message'],
        ]);

        return redirect()->route('tickets.show', $ticket)
            ->with('success', 'Votre réponse a été ajoutée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
