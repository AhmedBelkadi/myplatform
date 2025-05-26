<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'assignedSupport'])
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by client
        if ($request->filled('client_id')) {
            $query->where('user_id', $request->client_id);
        }

        // Filter by support
        if ($request->filled('support_id')) {
            $query->where('assigned_to', $request->support_id);
        }

        $tickets = $query->paginate(10);
        
        // Get users with role 'client'
        $clients = User::whereHas('role', function($query) {
            $query->where('name', 'Utilisateur');
        })->get();

        // Get users with role 'support'
        $supports = User::whereHas('role', function($query) {
            $query->where('name', 'Support');
        })->get();

        return view('admin.tickets.index', compact('tickets', 'clients', 'supports'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['user', 'assignedSupport', 'replies.user']);
        
        // Get users with role 'support' for the assign modal
        $supports = User::whereHas('role', function($query) {
            $query->where('name', 'support');
        })->get();

        return view('admin.tickets.show', compact('ticket', 'supports'));
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'support_id' => 'required|exists:users,id'
        ]);

        try {
            $ticket->update([
                'assigned_to' => $validated['support_id'],
                'status' => 'open' // Ensure ticket is open when assigned
            ]);

            return redirect()->route('admin.tickets.index')
                ->with('success', 'Ticket assigné avec succès !');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de l\'assignation du ticket : ' . $e->getMessage()]);
        }
    }

    public function close(Request $request, Ticket $ticket)
    {


        try {
            $ticket->update([
                'status' => 'resolved'
            ]);

            return redirect()->route('admin.tickets.index')
                ->with('success', 'Ticket fermé avec succès !');
        } catch (Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la fermeture du ticket : ' . $e->getMessage()]);
        }
    }
}
