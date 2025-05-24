@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Modifier le rôle : {{ $role->name }}</h2>
            
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom du rôle</label>
                    <input type="text" name="name" id="name" class="form-control block w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           value="{{ old('name', $role->name) }}" required>
                </div>

                <div class="form-group mb-4">
                    <label class="block text-sm font-medium text-gray-700">Permissions</label>
                    <div class="border p-3 rounded-md bg-gray-50">
                        @foreach ($permissions as $permission)
                        <div class="form-check mb-3">
                            <input type="checkbox" name="permissions[]" 
                                   value="{{ $permission->id }}" class="form-check-input h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                   id="perm_{{ $permission->id }}"
                                   @if(in_array($permission->id, $role->permissions->pluck('id')->toArray())) checked @endif>
                            <label class="form-check-label text-gray-700 ml-2" for="perm_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Mettre à jour le rôle
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
