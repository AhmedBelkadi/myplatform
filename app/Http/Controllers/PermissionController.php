<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;

class PermissionController extends Controller
{
    // Page qui affiche toutes les permissions
   // Page qui affiche toutes les permissions et rôles associés
public function index()
{
    $permissions = Permission::with('roles')->get();
    $roles = Role::all();
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
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name|max:255'
        ]);

        try {
            Permission::create($validated);
            return redirect()->route('admin.permissions.index')
                ->with('success', 'Permission créée avec succès !');
        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Erreur lors de la création de la permission : ' . $e->getMessage()]);
        }
    }

    // Supprimer une permission
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
            return redirect()->route('admin.permissions.index')
                ->with('success', 'Permission supprimée avec succès !');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la suppression de la permission : ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:permissions,name,' . $permission->id . '|max:255',
        ]);

        try {
            $permission->update($validated);
            return redirect()->route('admin.permissions.index')
                ->with('success', 'Permission mise à jour avec succès !');
        } catch (Exception $e) {
            return back()->withInput()
                ->withErrors(['error' => 'Erreur lors de la mise à jour de la permission : ' . $e->getMessage()]);
        }
    }

    public function assignRoles(Request $request, Permission $permission)
    {
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        try {
            $roles = $request->input('roles', []);
            $permission->roles()->sync($roles);
            return redirect()->route('admin.permissions.index')
                ->with('success', 'Rôles assignés avec succès !');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de l\'assignation des rôles : ' . $e->getMessage()]);
        }
    }
}
