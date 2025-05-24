<?php
// app/Http/Controllers/Admin/RoleController.php
// app/Http/Controllers/Admin/RoleController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission; // N'oubliez pas d'importer Permission pour la gestion des permissions

class RoleController extends Controller
{
    // Méthode pour afficher la liste des rôles
    public function index()
    {
        $roles = Role::all(); // Récupère tous les rôles
        return view('admin.roles.index', compact('roles'));
    }
    public function addPermissionForm($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        return view('admin.roles.add_permission', compact('role', 'permissions'));
    }

    // Ajouter une permission à un rôle
    public function addPermission(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);
        $permission = Permission::findOrFail($request->input('permission'));
        $role->permissions()->attach($permission);

        return redirect()->route('admin.roles.index')->with('success', 'Permission ajoutée avec succès');
    }

    // Méthode pour afficher le formulaire de création d'un rôle
    public function create()
    {
        // Vous pouvez ajouter ici une liste de permissions si vous voulez lier des permissions à un rôle lors de sa création
        $permissions = Permission::all(); // Récupère toutes les permissions
        return view('admin.roles.create', compact('permissions'));
    }

    // Méthode pour stocker un rôle dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name', // Valider le nom du rôle
            'permissions' => 'required|array', // Valider les permissions comme un tableau
        ]);
    
        $role = Role::create(['name' => $request->name]); // Créer un rôle avec le nom fourni
    
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->get(); // Récupère les permissions sélectionnées
            $role->syncPermissions($permissions); // Synchroniser les permissions avec le rôle
        }
    
        return redirect()->route('admin.roles.index')->with('success', 'Rôle créé avec succès.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id); // Trouver le rôle par ID
        $permissions = Permission::all(); // Récupérer toutes les permissions

        // Passer le rôle et les permissions à la vue
        return view('admin.roles.edit', compact('role', 'permissions'));
    }
    // app/Http/Controllers/Admin/RoleController.php

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|unique:roles,name,' . $id,
        'permissions' => 'required|array',
    ]);

    $role = Role::findOrFail($id);
    $role->name = $request->name;
    $role->save();

    if ($request->has('permissions')) {
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);
    }

    return redirect()->route('admin.roles.index')->with('success', 'Rôle mis à jour avec succès.');
}

    // Méthode pour supprimer un rôle
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Rôle supprimé avec succès');
    }
}
