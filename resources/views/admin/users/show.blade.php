@extends('layouts.viewlist')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Détails de l'utilisateur</h3>
        </div>
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $user->name }}</p>
            <p><strong>Email :</strong> {{ $user->email }}</p>
            {{-- Ajoute d'autres champs ici si nécessaire --}}
        </div>
    </div>
@endsection
