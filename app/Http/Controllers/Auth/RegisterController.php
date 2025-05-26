<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    protected $roleRedirects = [
        'Administrateur' => 'admin.dashboard',
        'Support' => 'support.dashboard',
        'Utilisateur' => 'tickets.index'
    ];

    public function __construct()
    {
        // Redirect to dashboard if already logged in
        $this->middleware(function ($request, $next) {
            if (session()->has('user')) {
                $userRole = session('user.role');
                return redirect()->route($this->roleRedirects[$userRole] ?? 'home');
            }
            return $next($request);
        });
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:Utilisateur,Support'],
        ]);

        try {
            // Get role first
            $roleName = $request->role === 'Support' ? 'Support' : 'Utilisateur';
            $role = Role::where('name', $roleName)->first();
            
            if (!$role) {
                return back()
                    ->withInput()
                    ->withErrors(['error' => 'Le rôle sélectionné n\'existe pas.']);
            }

            // Create user with role
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $role->id
            ]);

            // Store user data in session
            session([
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $roleName
                ]
            ]);

            // Get the appropriate redirect route based on role
            $redirectRoute = $this->roleRedirects[$roleName] ?? 'home';

            // Redirect with success message
            $messages = [
                'Support' => 'Bienvenue! Votre compte support a été créé avec succès.',
                'Utilisateur' => 'Bienvenue! Votre compte a été créé avec succès.',
                'Administrateur' => 'Bienvenue! Votre compte administrateur a été créé avec succès.'
            ];

            return redirect()->route('login')
                ->with('success', $messages[$roleName] ?? 'Votre compte a été créé avec succès.');

        } catch (Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création de votre compte. Veuillez réessayer.']);
        }
    }
} 
