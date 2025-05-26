@extends("layouts.index")

@section( "dashboard-active" , "active" )

@section("styles")
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
    .recent-activity {
        max-height: 400px;
        overflow-y: auto;
    }
    .chart-container {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
</style>
@endsection

@section("main")
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Bonjour, {{ Auth::user()->name }}</h1>
        <div class="text-muted">{{ now()->format('l, d F Y') }}</div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card bg-gray text-white h-100 rounded-3">
                <div class="card-body ">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Tickets Ouverts</h6>
                            <h2 class="mb-0">{{ $stats['open_tickets'] }}</h2>
                        </div>
                        <i class='bx bxs-message-square-detail bx-lg'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-success text-white h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Tickets Résolus</h6>
                            <h2 class="mb-0">{{ $stats['resolved_tickets'] }}</h2>
                        </div>
                        <i class='bx bxs-check-circle bx-lg'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-info text-white h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Aujourd'hui</h6>
                            <h2 class="mb-0">{{ $stats['tickets_today'] }}</h2>
                        </div>
                        <i class='bx bxs-calendar bx-lg'></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card bg-warning text-white h-100 rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Cette Semaine</h6>
                            <h2 class="mb-0">{{ $stats['solved_this_week'] }}</h2>
                        </div>
                        <i class='bx bxs-trophy bx-lg'></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="chart-container">
                <h5 class="card-title mb-3">Tendance des Tickets (7 derniers jours)</h5>
                <div id="ticketTrendsChart"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-container">
                <h5 class="card-title mb-3">Distribution par Statut</h5>
                <div id="ticketsByStatusChart"></div>
            </div>
        </div>
    </div>

    <!-- Recent Activity and New Tickets -->
    <div class="row">
        <div class="col-md-7">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Tickets Récemment Assignés</h5>
                    <a href="{{ route('support.tickets.index') }}" class="btn btn-sm btn-primary">Voir Tout</a>
                </div>
                <div class="card table-responsive">
                    <table class="table ticket-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sujet</th>
                                <th>Statut</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($newlyAssigned as $ticket)
                            <tr>
                                <td>#{{ $ticket->id }}</td>
                                <td>
                                    <a href="{{ route('support.tickets.show', $ticket) }}" class="text-decoration-none">
                                        {{ Str::limit($ticket->subject, 40) }}
                                    </a>
                                </td>
                                <td>
                                    <span class="status-badge {{ $ticket->status === 'open' ? 'status-open' : 'status-resolved' }}">
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
        <div class="col-md-5">
            <div class="chart-container">
                <h5 class="card-title mb-3">Activité Récente</h5>
                <div class="recent-activity">
                    @foreach($recentActivity as $activity)
                    <div class="d-flex align-items-start mb-3 p-2 border-bottom">
                        <div class="me-3">
                            <div class="avatar bg-light-primary p-2 rounded">
                                <i class='bx bxs-user'></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-1">
                                <a href="{{ route('support.tickets.show', $activity) }}" class="text-decoration-none">
                                    Ticket #{{ $activity->id }}
                                </a>
                            </h6>
                            <p class="text-muted mb-0">
                                {{ Str::limit($activity->subject, 60) }}
                                <br>
                                <small>{{ $activity->updated_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
    <script>
        // Ticket Trends Chart
        var ticketTrendsOptions = {
            series: [{
                name: 'Tickets',
                data: {!! json_encode($ticketTrends->pluck('count')) !!}
            }],
            chart: {
                height: 350,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            colors: ['#4F46E5'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3
                }
            },
            xaxis: {
                categories: {!! json_encode($ticketTrends->pluck('date')) !!},
                labels: {
                    formatter: function(value) {
                        return new Date(value).toLocaleDateString('fr-FR', { 
                            day: 'numeric',
                            month: 'short'
                        });
                    }
                }
            },
            tooltip: {
                x: {
                    format: 'dd MMM'
                }
            }
        };

        var ticketTrendsChart = new ApexCharts(document.querySelector("#ticketTrendsChart"), ticketTrendsOptions);
        ticketTrendsChart.render();

        // Tickets by Status Chart
        var ticketsByStatusOptions = {
            series: {!! json_encode($ticketsByStatus->pluck('count')) !!},
            chart: {
                type: 'donut',
                height: 350
            },
            labels: {!! json_encode($ticketsByStatus->pluck('status')) !!},
            colors: ['#4F46E5', '#10B981', '#F59E0B', '#EF4444'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '70%'
                    }
                }
            },
            legend: {
                position: 'bottom'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var ticketsByStatusChart = new ApexCharts(document.querySelector("#ticketsByStatusChart"), ticketsByStatusOptions);
        ticketsByStatusChart.render();
    </script>
@endsection
