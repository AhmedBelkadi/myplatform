@extends("layouts.index")

@section("tickets-active", "active")

@section("main")
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold"><i class='bx bx-support me-2'></i>Gestion des tickets</h4>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.tickets.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">
                        <i class='bx bx-filter-alt me-1'></i>Status
                    </label>
                    <select name="status" class="form-select">
                        <option value="">Tous les status</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Ouvert</option>
                        <option value="resolved" {{ request('status') == 'closed' ? 'selected' : '' }}>Résolu</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">
                        <i class='bx bx-user me-1'></i>Client
                    </label>
                    <select name="client_id" class="form-select">
                        <option value="">Tous les clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">
                        <i class='bx bx-user-check me-1'></i>Support assigné
                    </label>
                    <select name="support_id" class="form-select">
                        <option value="">Tout le support</option>
                        @foreach($supports as $support)
                            <option value="{{ $support->id }}" {{ request('support_id') == $support->id ? 'selected' : '' }}>
                                {{ $support->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class='bx bx-filter me-1'></i>Filtrer
                    </button>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-outline-secondary">
                        <i class='bx bx-reset me-1'></i>Réinitialiser
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Sujet</th>
                        <th class="text-center">Client</th>
                        <th class="text-center">Support assigné</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Dernière mise à jour</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($tickets as $ticket)
                        <tr class="text-center">
                            <td class="text-center">{{ $ticket->title }}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center">
                                    <i class='bx bx-user me-1'></i>
                                    {{ $ticket->user->name }}
                                </div>
                            </td>
                            <td class="text-center" >
                                @if($ticket->assigned_to)
                                    <div class="d-flex align-items-center">
                                        <i class='bx bx-user-check me-1'></i>
                                        {{ $ticket->assignedSupport->name }}
                                    </div>
                                @else
                                    <span class="text-muted">Non assigné</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($ticket->status === 'open')
                                    <span class="badge bg-success">Ouvert</span>
                                @else
                                    <span class="badge bg-secondary">Résolu</span>
                                @endif
                               
                            </td>
                            <td class="text-center">{{ $ticket->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.tickets.show', $ticket->id) }}" 
                                   class="btn btn-info btn-sm text-white"
                                   title="Voir les détails">
                                    <i class="menu-icon tf-icons bx bx-show"></i>
                                </a>

                                <button type="button"
                                        class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#assignModal{{$ticket->id}}"
                                        title="Assigner le ticket">
                                    <i class="menu-icon tf-icons bx bx-user-plus"></i>
                                </button>

                                @if($ticket->status === 'open')
                                    <button type="button"
                                            class="btn btn-warning btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#closeModal{{$ticket->id}}"
                                            title="Résolu le ticket">
                                        <i class="menu-icon tf-icons bx bx-door-open"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>

                        @include('admin.tickets.assign', ['ticket' => $ticket])
                        @include('admin.tickets.close', ['ticket' => $ticket])
                    @endforeach
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
