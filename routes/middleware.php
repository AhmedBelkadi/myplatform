<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Http\Middleware\HandleCors;
// autres imports nécessaires

return [
    // Middlewares globaux
    'web' => [
        // middlewares du groupe web existants
    ],
    
    'api' => [
        // middlewares du groupe api existants
    ],
    
    // Middlewares avec alias
    'aliases' => [
        'role' => RoleMiddleware::class,
        // autres aliases...
    ],
];