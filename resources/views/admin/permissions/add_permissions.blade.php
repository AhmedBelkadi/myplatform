@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Ajouter une permission à {{ ucfirst($role->name) }}</h1>

    <form action="{{ route('admin.roles.add-permission.store', $role->id) }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="permission" class="block text-sm font-medium text-gray-700">Choisir une permission :</label>
            <select name="permission" id="permission" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
            Ajouter la permission
        </button>
    </form>
</div>
@endsection
