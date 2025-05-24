@extends('layouts.list')
@section('content')
<style>
/* Styles généraux */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
}

/* Conteneur principal */
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

/* En-tête */
.page-title {
  font-size: 24px;
  color: #2c3e50;
  margin-bottom: 25px;
}

/* Message de succès */
.alert-success {
  background-color: #d4edda;
  color: #155724;
  padding: 12px 15px;
  border-radius: 4px;
  margin-bottom: 20px;
}

/* Formulaire */
.user-form {
  background-color: white;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

.form-group {
  margin-bottom: 20px;
}

.form-label {
  display: block;
  margin-bottom: 8px;
  font-weight: 500;
  color: #2c3e50;
}

.form-control {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 15px;
}

.form-control:focus {
  border-color: #3498db;
  outline: none;
  box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
}

.error-message {
  color: #e74c3c;
  font-size: 13px;
  margin-top: 5px;
}

/* Bouton de soumission */
.btn-submit {
  background-color: #3498db;
  color: white;
  padding: 10px 18px;
  border-radius: 4px;
  border: none;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
}

.btn-submit:hover {
  background-color: #2980b9;
}
</style>

<div class="container">
    <h1 class="page-title">Créer un Nouvel Utilisateur</h1>
    
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('admin.users.store') }}" method="POST" class="user-form">
        @csrf
        
        <div class="form-group">
            <label for="name" class="form-label">Nom</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" id="telephone" name="telephone" class="form-control" value="{{ old('telephone') }}">
            @error('telephone')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" id="ville" name="ville" class="form-control" value="{{ old('ville') }}">
            @error('ville')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn-submit">Créer l'utilisateur</button>
    </form>
</div>
@endsection