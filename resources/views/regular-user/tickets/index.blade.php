@extends('layouts.index')

@section('tickets-active', 'active')

@section('main')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class='bx bx-ticket me-2'></i>Mes tickets
            </h4>
            <p class="text-muted mb-0">Gérez et suivez vos tickets de support</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
            <i class='bx bx-plus-circle me-1'></i>Nouveau ticket
        </a>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('tickets.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="status" class="form-label">Statut</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Ouvert</option>
                        <option value="resolved" {{ request('status') === 'resolved' ? 'selected' : '' }}>Résolu</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label">Rechercher</label>
                    <input type="text" 
                           class="form-control" 
                           id="search" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Rechercher par titre...">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class='bx bx-filter-alt me-1'></i>Filtrer
                    </button>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                        <i class='bx bx-reset me-1'></i>Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tickets List -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>№ Ticket</th>
                        <th>Titre</th>
                        <th>Statut</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td>#{{ $ticket->id }}</td>
                            <td>{{ $ticket->title }}</td>
                            <td>
                                @switch($ticket->status)
                                    @case('open')
                                        <span class="badge bg-primary">Ouvert</span>
                                        @break
                                    @case('resolved')
                                        <span class="badge bg-success">Résolu</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('tickets.show', $ticket) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class='bx bx-show me-1'></i>Voir
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class='bx bx-info-circle mb-2 fs-3'></i>
                                    <p class="mb-0">Aucun ticket trouvé</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tickets->hasPages())
            <div class="card-footer">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    // Initialize date inputs with flatpickr if needed
    document.addEventListener('DOMContentLoaded', function() {
        // You can add any additional JavaScript for the filters here
    });
</script>
@endsection
