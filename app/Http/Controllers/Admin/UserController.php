<?php  
namespace App\Http\Controllers\Admin; // Attention à bien vérifier ton namespace (admin ou pas)

use App\Http\Controllers\Controller;
use App\Models\User; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;  

class UserController extends Controller 
{     
    // Affiche tous les utilisateurs     
    public function index()     
    {         
        $users = User::all();      
        return view('admin.users.index', compact('users'));     
    }          
    
    // Affiche le formulaire de création d'un utilisateur     
    public function create()     
    {         
        return view('admin.users.create');     
    }      
    
    // Enregistre un nouvel utilisateur     
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'telephone' => 'nullable|string|max:255',
                'ville' => 'nullable|string|max:255',
                'role' => 'required|string|exists:roles,name', // le rôle doit exister dans la table roles
            ]);
        
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telephone' => $request->telephone,
                'ville' => $request->ville,
            ]);
        
            $user->assignRole($request->role);
        
            return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    // Affiche le formulaire d'édition d'un utilisateur     
    public function edit($id)     
    {         
        $user = User::findOrFail($id);         
        return view('admin.users.edit', compact('user'));     
    }      
    
    // Met à jour un utilisateur existant     
    public function update(Request $request, $id)     
    {         
        try {
            $user = User::findOrFail($id);
            
            $request->validate([             
                'name' => 'required|string|max:255',             
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6|confirmed', // si mot de passe modifié
                'telephone' => 'nullable|string|max:255',
                'ville' => 'nullable|string|max:255',
                'role' => 'nullable|string|exists:roles,name',
            ]);          
            
            $user->name = $request->name;
            $user->email = $request->email;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->telephone = $request->telephone;
            $user->ville = $request->ville;
            $user->save();

            if ($request->has('role')) {
                $user->syncRoles([$request->role]);
            }
            
            return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }      // app/Http/Controllers/Admin/UserController.php

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    
    
    // Supprime un utilisateur     
    public function destroy($id)     
    {         
        $user = User::findOrFail($id);
        $user->delete();          
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');     
    } 
}
