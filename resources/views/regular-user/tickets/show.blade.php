@extends('layouts.index')

@section('tickets-active', 'active')

@section('main')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class='bx bx-ticket me-2'></i>Détails du ticket
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('tickets.index') }}">Mes tickets</a>
                    </li>
                    <li class="breadcrumb-item active">Ticket #{{ $ticket->id }}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
            <i class='bx bx-arrow-back me-1'></i>Retour
        </a>
    </div>

    <div class="row">
        <!-- Main Content -->
        <div class="col-md-8">
            <!-- Ticket Details -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $ticket->title }}</h5>
                    @switch($ticket->status)
                        @case('open')
                            <span class="badge bg-primary">Ouvert</span>
                            @break
                        @case('resolved')
                            <span class="badge bg-success">Résolu</span>
                            @break
                    @endswitch
                </div>
                <div class="card-body">
                    <!-- Original Message -->
                    <div class="mb-4">
                        <h6 class="fw-bold">Description</h6>
                        <p class="text-muted mb-0">{{ $ticket->description }}</p>
                    </div>

                    <!-- Message Thread -->
                    <div class="mt-4">
                        <h6 class="fw-bold mb-3">Conversation</h6>
                        <div class="chat-messages p-4">
                            <!-- Original Ticket Message -->
                            <div class="chat-message-left pb-4">
                                <div>
                                    <div class="text-muted d-flex justify-content-start align-items-center mb-1">
                                        <strong class="me-2">{{ $ticket->user->name }}</strong>
                                        <small class="ms-2">{{ $ticket->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3">
                                        {{ $ticket->description }}
                                    </div>
                                </div>
                            </div>

                            <!-- Replies -->
                            @foreach($ticket->replies as $reply)
                                <div class="chat-message-{{ $reply->user->hasRole('support') ? 'right' : 'left' }} pb-4">
                                    <div>
                                        <div class="text-muted d-flex justify-content-{{ $reply->user->hasRole('support') ? 'end' : 'start' }} align-items-center mb-1">
                                            <strong class="me-2">{{ $reply->user->name }}</strong>
                                            @if($reply->user->hasRole('support'))
                                                <span class="badge bg-info">Support</span>
                                            @endif
                                            <small class="ms-2">{{ $reply->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="flex-shrink-1 {{ $reply->user->hasRole('support') ? 'bg-primary text-white' : 'bg-light' }} rounded py-2 px-3">
                                            {{ $reply->message }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Reply Form -->
                        @if($ticket->status !== 'resolved')
                            <div class="mt-4">
                                <form action="{{ route('tickets.reply', $ticket) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Votre réponse</label>
                                        <textarea class="form-control @error('message') is-invalid @enderror"
                                                id="message"
                                                name="message"
                                                rows="3"
                                                placeholder="Tapez votre message ici..."
                                                required></textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class='bx bx-send me-1'></i>Envoyer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="alert alert-info mt-4">
                                <i class='bx bx-info-circle me-1'></i>
                                Ce ticket est résolu. Vous ne pouvez plus y répondre.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Ticket Information -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Informations</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <span>
                                <i class='bx bx-hash me-2'></i>Numéro
                            </span>
                            <span class="text-muted">#{{ $ticket->id }}</span>
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
                        @if($ticket->assignedSupport)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>
                                    <i class='bx bx-user me-2'></i>Agent assigné
                                </span>
                                <span class="text-muted">{{ $ticket->assignedSupport->name }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .chat-messages {
        max-height: 500px;
        overflow-y: auto;
    }
    .chat-message-left {
        margin-right: 20%;
    }
    .chat-message-right {
        margin-left: 20%;
    }
</style>
@endsection
