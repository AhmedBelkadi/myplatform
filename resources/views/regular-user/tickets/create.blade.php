@extends('layouts.index')

@section('tickets-active', 'active')

@section('main')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class='bx bx-plus-circle me-2'></i>Nouveau ticket
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('tickets.index') }}">Mes tickets</a>
                    </li>
                    <li class="breadcrumb-item active">Nouveau ticket</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
            <i class='bx bx-arrow-back me-1'></i>Retour
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Créer un nouveau ticket</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">
                                <i class='bx bx-text me-1'></i>Titre du ticket
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}" 
                                   placeholder="Ex: Problème de connexion"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class='bx bx-detail me-1'></i>Description du problème
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="6" 
                                      placeholder="Décrivez votre problème en détail..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Veuillez fournir autant de détails que possible pour nous aider à résoudre votre problème.
                            </small>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-send me-1'></i>Soumettre le ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 