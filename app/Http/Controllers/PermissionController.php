<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    // Page qui affiche toutes les permissions
   // Page qui affiche toutes les permissions et rôles associés
public function index()
{
    // Récupérer toutes les permissions
    $permissions = Permission::all();

    // Récupérer tous les rôles avec leurs permissions
    $roles = Role::with('permissions')->get();

    // Retourner la vue avec les permissions et rôles
    return view('admin.permissions.index', compact('permissions', 'roles'));
}


    // Page du formulaire pour assigner des permissions à un rôle
    public function assignForm()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.permissions.assign', compact('roles', 'permissions'));
    }

    // Action qui traite l'assignation
    public function assign(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'permissions' => 'required|array',
        ]);

        $role = Role::findByName($request->role);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $permissionNames = $permissions->pluck('name')->toArray();

        $role->syncPermissions($permissionNames);

        return redirect()->route('admin.permissions.assign-form')
            ->with('success', 'Permissions assignées avec succès.');
    }

    // Créer une nouvelle permission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permission créée avec succès.');
    }

    // Supprimer une permission
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Permission supprimée avec succès.');
    }
}
