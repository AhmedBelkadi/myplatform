@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Créer un nouveau rôle</h1>
    
    <form action="{{ route('admin.roles.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nom du rôle</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Permissions</label>
            <div class="border border-gray-300 rounded-lg p-4">
                @foreach($permissions as $permission)
                <div class="flex items-center mb-3">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                           id="perm_{{ $permission->id }}" class="mr-2 rounded-lg border-gray-300 focus:ring-blue-500">
                    <label for="perm_{{ $permission->id }}" class="text-gray-600">{{ $permission->name }}</label>
                </div>
                @endforeach
            </div>
        </div>
        
        <button type="submit" class="w-full py-2 px-4 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
            Créer le rôle
        </button>
    </form>
</div>
@endsection
