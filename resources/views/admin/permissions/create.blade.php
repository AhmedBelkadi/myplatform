{{-- resources/views/admin/roles/create.blade.php --}}
@extends('layouts.admin') <!-- Inclure le layout général -->

@section('content')
    <h1>Créer un rôle</h1>
    
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom du rôle</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="permissions">Permissions</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple required>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Créer le rôle</button>
    </form>
@endsection
