<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportDashboardController extends Controller
{
    public function index()
    {
        $supportId = Auth::id();
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();

        // Basic stats
        $stats = [
            'open_tickets' => Ticket::where('assigned_to', $supportId)
                                  ->where('status', 'open')
                                  ->count(),
            'resolved_tickets' => Ticket::where('assigned_to', $supportId)
                                      ->where('status', 'resolved')
                                      ->count(),
            'tickets_today' => Ticket::where('assigned_to', $supportId)
                                    ->whereDate('created_at', $today)
                                    ->count(),
            'solved_this_week' => Ticket::where('assigned_to', $supportId)
                                       ->where('status', 'resolved')
                                       ->where('updated_at', '>=', $weekStart)
                                       ->count(),
        ];

        // Newly assigned tickets
        $newlyAssigned = Ticket::where('assigned_to', $supportId)
                              ->where('status', 'open')
                              ->orderBy('created_at', 'desc')
                              ->take(5)
                              ->get();

        // Recent activity (last 10 actions)
        $recentActivity = Ticket::where('assigned_to', $supportId)
                               ->with(['user', 'replies' => function($query) {
                                   $query->latest()->take(1);
                               }])
                               ->latest()
                               ->take(10)
                               ->get();

        // Daily ticket trends for the last 7 days
        $ticketTrends = Ticket::where('assigned_to', $supportId)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            ]);

        // Tickets by status distribution
        $ticketsByStatus = Ticket::where('assigned_to', $supportId)
            ->groupBy('status')
            ->select('status', DB::raw('count(*) as count'))
            ->get();

        // Response time average (in hours)
        $averageResponseTime = Ticket::where('assigned_to', $supportId)
            ->where('status', 'resolved')
            ->whereNotNull('updated_at')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) as avg_response_time'))
            ->first();

        return view('support.dashboard', compact(
            'stats',
            'newlyAssigned',
            'recentActivity',
            'ticketTrends',
            'ticketsByStatus',
            'averageResponseTime'
        ));
    }
}
