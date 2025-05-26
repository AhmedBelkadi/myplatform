@extends('layouts.index')

@section('tickets-active', 'active')

@section('main')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">
            <i class='bx bx-support me-2'></i>Mes tickets
        </h4>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('support.tickets.index') }}" class="row g-3">
                <!-- Status Filter -->
                <div class="col-md-3">
                    <label class="form-label">
                        <i class='bx bx-filter-alt me-1'></i>Status
                    </label>
                    <select name="status" class="form-select">
                        <option value="">Tous les status</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Ouvert</option>
                        <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Résolu</option>
                    </select>
                </div>

                <!-- Date Range Filter -->
                <div class="col-md-3">
                    <label class="form-label">
                        <i class='bx bx-calendar me-1'></i>Date de début
                    </label>
                    <input type="date" 
                           name="start_date" 
                           class="form-control" 
                           value="{{ request('start_date') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">
                        <i class='bx bx-calendar me-1'></i>Date de fin
                    </label>
                    <input type="date" 
                           name="end_date" 
                           class="form-control" 
                           value="{{ request('end_date') }}">
                </div>

                <!-- Search -->
                <div class="col-md-3">
                    <label class="form-label">
                        <i class='bx bx-search me-1'></i>Rechercher
                    </label>
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Titre, description ou client..."
                           value="{{ request('search') }}">
                </div>

                <!-- Filter Buttons -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class='bx bx-filter me-1'></i>Filtrer
                    </button>
                    <a href="{{ route('support.tickets.index') }}" class="btn btn-outline-secondary">
                        <i class='bx bx-reset me-1'></i>Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tickets Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Titre</th>
                        <th class="text-center">Client</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Date de création</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($tickets as $ticket)
                        <tr class="text-center">
                            <td class="text-center">{{ $ticket->title }}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class='bx bx-user me-1'></i>
                                    {{ $ticket->user->name }}
                                </div>
                            </td>
                            <td class="text-center">
                                @if($ticket->status === 'open')
                                    <span class="badge bg-success">Ouvert</span>
                                @else
                                    <span class="badge bg-secondary">Résolu</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $ticket->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('support.tickets.show', $ticket->id) }}" 
                                   class="btn btn-info btn-sm text-white"
                                   title="Voir les détails">
                                    <i class="menu-icon tf-icons bx bx-show"></i>
                                </a>

                                @if($ticket->status === 'open')
                                    <form action="{{ route('support.tickets.resolve', $ticket->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-success btn-sm"
                                                title="Marquer comme résolu"
                                                onclick="return confirm('Êtes-vous sûr de vouloir marquer ce ticket comme résolu ?')">
                                            <i class="menu-icon tf-icons bx bx-check"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class='bx bx-support fs-3 mb-2'></i>
                                    <p class="mb-0">Aucun ticket trouvé</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($tickets->total() >= 10)
            <div class="card-footer">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
@endsection


