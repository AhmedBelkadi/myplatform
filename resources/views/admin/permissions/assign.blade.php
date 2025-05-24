@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Assigner des Permissions à un Rôle</h1>

    <form action="{{ route('admin.permissions.assign') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Choisir un Rôle :</label>
            <select name="role" id="role" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="permissions" class="block text-sm font-medium text-gray-700">Choisir les Permissions :</label>
            <select name="permissions[]" id="permissions" multiple class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
            Assigner Permissions
        </button>
    </form>
</div>
@endsection
