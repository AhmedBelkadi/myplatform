<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomGuest
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('user')) {
            $userRole = session('user.role');
            
            // Redirect based on role
            $redirects = [
                'Administrateur' => 'admin.dashboard',
                'Support' => 'support.dashboard',
                'Utilisateur' => 'tickets.index'
            ];

            return redirect()->route($redirects[$userRole] ?? 'home')
                ->with('info', 'Vous êtes déjà connecté.');
        }

        return $next($request);
    }
} 