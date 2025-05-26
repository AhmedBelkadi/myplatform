<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth()->check() || !auth()->user()->hasPermission($permission)) {
            return redirect()->back()->with('error', 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}
