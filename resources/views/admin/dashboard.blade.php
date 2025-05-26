@extends('layouts.index')

@section('dashboard-active', 'active')

@section('styles')
<style>
    .stat-card {
        transition: transform 0.3s ease;
        border-radius: 10px;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .chart-container {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    .ticket-table th, .ticket-table td {
        padding: 12px;
        white-space: nowrap;
    }
    .status-badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.85rem;
    }
    .status-open { background-color: #e3f2fd; color: #1976d2; }
    .status-resolved { background-color: #e8f5e9; color: #2e7d32; }
    .status-pending { background-color: #fff3e0; color: #f57c00; }
    .status-closed { background-color: #f5f5f5; color: #616161; }
    .performance-bar {
        height: 8px;
        border-radius: 4px;
        background: #e9ecef;
    }
    .performance-bar-fill {
        height: 100%;
        border-radius: 4px;
        background: #4F46E5;
        transition: width 0.3s ease;
    }
    .chart-wrapper {
        position: relative;
        min-height: 400px;
    }
</style>
@endsection

@section('main')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-4">Tableau de Bord Administrateur</h4>
        <div class="text-muted">{{ now()->format('l, d F Y') }}</div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="stat-card bg-gray text-white h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                <div>
                            <h6 class="card-title mb-1">Total Tickets</h6>
                            <h2 class="mb-0">{{ $stats['total_tickets'] }}</h2>
                            <div class="mt-3 small">
                                <span class="me-2">
                                    <i class='bx bxs-circle text-success'></i> {{ $stats['tickets_by_status']['resolved'] }} Résolus
                                </span>
                                <span>
                                    <i class='bx bxs-circle text-warning'></i> {{ $stats['tickets_by_status']['open'] }} Ouverts
                                </span>
                            </div>
                        </div>
                        <i class='bx bxs-dashboard bx-lg'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="stat-card bg-success text-white h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                <div>
                            <h6 class="card-title mb-1">Utilisateurs</h6>
                            <h2 class="mb-0">{{ $stats['total_users'] }}</h2>
                        </div>
                        <i class='bx bxs-group bx-lg'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="stat-card bg-warning text-white h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                <div>
                            <h6 class="card-title mb-1">Non Assignés</h6>
                            <h2 class="mb-0">{{ $stats['unassigned_tickets'] }}</h2>
                        </div>
                        <i class='bx bxs-error bx-lg'></i>
                    </div>
                </div>
            </div>
        </div>
       
            </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-xl-8">
            <div class="chart-container h-100">
                <h5 class="card-title mb-3">Tendance des Tickets (4 dernières semaines)</h5>
                <div class="chart-wrapper">
                    <div id="weeklyTrendsChart"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="chart-container h-100">
                <h5 class="card-title mb-3">Activité Journalière</h5>
                <div class="chart-wrapper">
                    <div id="dailyActivityChart"></div>
                </div>
            </div>
                </div>
            </div>

    <!-- Latest Tickets and Support Performance -->
    <div class="row g-4">
        <div class="col-12 col-xl-7">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Derniers Tickets</h5>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-primary">Voir Tout</a>
                </div>
                <div class="table-responsive">
                    <table class="table ticket-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sujet</th>
                                <th>Utilisateur</th>
                                <th>Assigné à</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestTickets as $ticket)
                            <tr>
                                <td>#{{ $ticket->id }}</td>
                                <td>
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-decoration-none">
                                        {{ Str::limit($ticket->title, 30) }}
                                    </a>
                                </td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $ticket->assignedTo ? $ticket->assignedTo->name : 'Non assigné' }}</td>
                                <td>
                                <span class="status-badge status-{{ $ticket->status }}">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                                </td>
                                <td>{{ $ticket->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-5">
            <div class="chart-container">
                <h5 class="card-title mb-3">Performance Support (Top 5)</h5>
                @foreach($supportPerformance as $support)
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span>{{ $support->name }}</span>
                        <span class="text-muted small">{{ $support->resolution_rate }}%</span>
                    </div>
                    <div class="performance-bar">
                        <div class="performance-bar-fill" style="width: {{ $support->resolution_rate }}%"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-1">
                        <small class="text-muted">{{ $support->resolved_tickets }} résolus</small>
                        <small class="text-muted">{{ $support->total_tickets }} total</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Prepare the data
    const weeklyData = {!! json_encode($weeklyTrends) !!};
    const dailyData = {!! json_encode($dailyActivity) !!};

    // Weekly Trends Chart
    const weeklyTrendsOptions = {
        series: [{
            name: 'Tickets',
            data: weeklyData.map(item => parseInt(item.count))
        }],
        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        colors: ['#4F46E5'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.7,
                opacityTo: 0.3
            }
        },
        xaxis: {
            type: 'category',
            categories: weeklyData.map(item => {
                const date = new Date(item.week_start);
                return date.toLocaleDateString('fr-FR', {
                    day: 'numeric',
                    month: 'short'
                });
            })
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return Math.round(val);
                }
            }
        }
    };

    // Daily Activity Chart
    const dailyActivityOptions = {
        series: [{
            name: 'Tickets',
            data: dailyData.map(item => parseInt(item.count))
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '60%',
            }
        },
        colors: ['#10B981'],
        dataLabels: {
            enabled: false
        },
        xaxis: {
            type: 'category',
            categories: dailyData.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('fr-FR', {
                    weekday: 'short'
                });
            })
        },
        yaxis: {
            labels: {
                formatter: function(val) {
                    return Math.round(val);
                }
            }
        }
    };

    // Initialize charts
    try {
        if (document.querySelector("#weeklyTrendsChart")) {
            const weeklyChart = new ApexCharts(
                document.querySelector("#weeklyTrendsChart"), 
                weeklyTrendsOptions
            );
            weeklyChart.render();
        }
        
        if (document.querySelector("#dailyActivityChart")) {
            const dailyChart = new ApexCharts(
                document.querySelector("#dailyActivityChart"), 
                dailyActivityOptions
            );
            dailyChart.render();
        }
    } catch (error) {
        console.error('Error initializing charts:', error);
    }
});
    </script>
@endsection
