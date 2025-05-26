<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    // Affiche la liste des rôles
    public function index()
    {
        $roles = Role::withCount('users')->with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    // Crée un nouveau rôle
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name|max:255',
        ]);

        try {
            Role::create(['name' => $request->name]);
            return redirect()->route('admin.roles.index')->with('success', 'Rôle ajouté avec succès !');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Erreur lors de la création du rôle : ' . $e->getMessage()]);
        }
    }

    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        try {
            $permissions = $request->input('permissions', []);
            $role->permissions()->sync($permissions);
            return redirect()->route('admin.roles.index')->with('success', 'Permissions mises à jour avec succès !');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la mise à jour des permissions : ' . $e->getMessage()]);
        }
    }

    // Supprime un rôle
    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect()->route('admin.roles.index')->with('success', 'Rôle supprimé avec succès !');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Erreur lors de la suppression du rôle : ' . $e->getMessage()]);
        }
    }
}
