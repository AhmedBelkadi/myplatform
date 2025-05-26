@extends('layouts.index')

@section('tickets-active', 'active')

@section('main')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class='bx bx-support me-2'></i>Détails du ticket
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.tickets.index') }}">Tickets</a>
                    </li>
                    <li class="breadcrumb-item active">Détails</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">
            <i class='bx bx-arrow-back me-1'></i>Retour
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Ticket Details -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $ticket->title }}</h5>
                    <span class="badge {{ $ticket->status === 'open' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $ticket->status === 'open' ? 'Ouvert' : 'Résolu' }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold">Description</h6>
                        <p class="text-muted">{{ $ticket->description }}</p>
                    </div>

                    @if($ticket->closing_note && $ticket->status === 'closed')
                        <div class="alert alert-secondary">
                            <h6 class="fw-bold">Note de clôture</h6>
                            <p class="mb-0">{{ $ticket->closing_note }}</p>
                        </div>
                    @endif

                    <!-- Ticket Replies -->
                    <div class="mt-4">
                        <h6 class="fw-bold mb-3">Réponses</h6>
                        @forelse($ticket->replies as $reply)
                            <div class="border-start border-3 ps-3 mb-3 {{ $reply->user->role->name === 'support' ? 'border-primary' : 'border-secondary' }}">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <span class="fw-bold">{{ $reply->user->name }}</span>
                                        <span class="badge {{ $reply->user->role->name === 'support' ? 'bg-primary' : 'bg-secondary' }} ms-2">
                                            {{ ucfirst($reply->user->role->name) }}
                                        </span>
                                    </div>
                                    <small class="text-muted">{{ $reply->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="mb-0">{{ $reply->message }}</p>
                            </div>
                        @empty
                            <div class="text-center text-muted">
                                <i class='bx bx-message-square-dots fs-3'></i>
                                <p>Aucune réponse pour le moment</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Ticket Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informations</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>
                                <i class='bx bx-user me-2'></i>Client
                            </span>
                            <span class="text-muted">{{ $ticket->user->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>
                                <i class='bx bx-user-check me-2'></i>Support assigné
                            </span>
                            @if($ticket->assigned_to)
                                <span class="text-muted">{{ $ticket->assignedSupport->name }}</span>
                            @else
                                <span class="badge bg-warning">Non assigné</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>
                                <i class='bx bx-calendar me-2'></i>Créé le
                            </span>
                            <span class="text-muted">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>
                                <i class='bx bx-refresh me-2'></i>Dernière mise à jour
                            </span>
                            <span class="text-muted">{{ $ticket->updated_at->format('d/m/Y H:i') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <button type="button"
                            class="btn btn-primary w-100 mb-2"
                            data-bs-toggle="modal"
                            data-bs-target="#assignModal{{$ticket->id}}">
                        <i class='bx bx-user-plus me-1'></i>Assigner le ticket
                    </button>

                    @if($ticket->status === 'open')
                        <button type="button"
                                class="btn btn-warning w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#closeModal{{$ticket->id}}">
                            <i class='bx bx-door-open me-1'></i>Résolu le ticket
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('admin.tickets.assign', ['ticket' => $ticket])
    @include('admin.tickets.close', ['ticket' => $ticket])
@endsection 