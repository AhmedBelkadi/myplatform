<!-- Dans admin/permissions/index.blade.php -->
@extends('layouts.app')

@section('content')
<style>
/* Styles généraux */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  color: #333;
  line-height: 1.6;
}

/* Styles du conteneur */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

/* Titre de la page */
.page-title {
  color: #2c3e50;
  margin-bottom: 25px;
  font-weight: 600;
}

/* Styles du tableau */
.roles-table {
  width: 100%;
  border-collapse: collapse;
  box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  overflow: hidden;
}

.roles-table thead {
  background-color: #3498db;
  color: white;
}

.roles-table th {
  padding: 15px;
  text-align: left;
  font-weight: 600;
  font-size: 14px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.roles-table td {
  padding: 12px 15px;
  border-bottom: 1px solid #e9ecef;
}

.roles-table tbody tr:hover {
  background-color: #f8f9fa;
}

.roles-table tbody tr:last-child td {
  border-bottom: none;
}

/* Style pour les permissions */
.permission-tag {
  display: inline-block;
  background-color: #e9f5fe;
  color: #3498db;
  border-radius: 20px;
  padding: 4px 10px;
  margin: 2px;
  font-size: 12px;
  border: 1px solid #cce5ff;
}

/* Styles des boutons */
.btn {
  display: inline-block;
  padding: 8px 16px;
  border-radius: 4px;
  font-size: 13px;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.2s ease;
  border: none;
  cursor: pointer;
  margin-right: 8px;
}

.btn-edit {
  background-color: #f39c12;
  color: white;
}

.btn-edit:hover {
  background-color: #e67e22;
}

.btn-delete {
  background-color: #e74c3c;
  color: white;
}

.btn-delete:hover {
  background-color: #c0392b;
}

/* Style pour les actions */
.actions-cell {
  white-space: nowrap;
}
</style>

<div class="container">
    <h1 class="page-title">Gestion des rôles et permissions</h1>
    
    <table class="roles-table">
        <thead>
            <tr>
                <th>Rôle</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ ucfirst($role->name) }}</td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="permission-tag">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td class="actions-cell">
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-edit">Modifier</a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection