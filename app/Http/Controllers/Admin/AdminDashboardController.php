<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Basic stats
        $stats = [
            'total_tickets' => Ticket::count(),
            'total_users' => User::count(),
            'unassigned_tickets' => Ticket::whereNull('assigned_to')->count(),
            'tickets_by_status' => [
                'open' => Ticket::where('status', 'open')->count(),
                'resolved' => Ticket::where('status', 'resolved')->count(),
            ]
        ];

        // Latest tickets
        $latestTickets = Ticket::with(['user', 'assignedSupport'])
                              ->latest()
                              ->take(5)
                              ->get();

        // Weekly ticket trends (last 4 weeks)
        $weeklyTrends = Ticket::select([
            DB::raw('DATE(DATE_SUB(created_at, INTERVAL WEEKDAY(created_at) DAY)) as week_start'),
            DB::raw('COUNT(*) as count')
        ])
        ->where('created_at', '>=', Carbon::now()->subWeeks(4))
        ->groupBy('week_start')
        ->orderBy('week_start')
        ->get();

        // Daily activity for the current week
        $dailyActivity = Ticket::select([
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        ])
        ->where('created_at', '>=', Carbon::now()->startOfWeek())
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        // Support staff performance (tickets resolved)
        $supportPerformance = User::whereHas('role', function($query) {
                $query->where('name', 'Support');
            })
            ->withCount([
                'assignedTickets as total_tickets',
                'assignedTickets as resolved_tickets' => function($query) {
                    $query->where('status', 'resolved');
                }
            ])
            ->having('total_tickets', '>', 0)
            ->take(5)
            ->get()
            ->map(function ($user) {
                $user->resolution_rate = $user->total_tickets > 0
                    ? round(($user->resolved_tickets / $user->total_tickets) * 100, 1)
                    : 0;
                return $user;
            });

        // dd($weeklyTrends,$dailyActivity);

            return view('admin.dashboard', compact(
            'stats',
            'latestTickets',
            'weeklyTrends',
            'dailyActivity',
            'supportPerformance'
        ));
    }

    // Get tickets created per day for the last 7 days
    private function getTicketTrends()
    {
        return Ticket::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    // Get tickets by status
    private function getTicketsByStatus()
    {
        return Ticket::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get();
    }

    // Get users by role
    private function getUsersByRole()
    {
        return Role::withCount('users')
            ->get();
    }
}
