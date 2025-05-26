<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// ADMIN ROUTES
Route::middleware(['auth', 'role:Administrateur'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware(['permission:view_admin_dashboard']);

    Route::middleware('permission:manage_users')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::middleware('permission:manage_roles')->group(function () {
        Route::resource('roles', RoleController::class);
        Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
    });

    Route::middleware('permission:manage_permissions')->group(function () {
        Route::resource('permissions', PermissionController::class);
        Route::put('/permissions/{permission}/roles', [PermissionController::class, 'assignRoles'])->name('permissions.assign-roles');
    });

    Route::middleware('permission:view_all_tickets')->group(function () {
        Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
    });

    Route::post('/tickets/{ticket}/assign', [AdminTicketController::class, 'assign'])
        ->name('tickets.assign')
        ->middleware('permission:assign_ticket');

    Route::put('/tickets/{ticket}/close', [AdminTicketController::class, 'close'])
        ->name('tickets.close')
        ->middleware('permission:close_ticket');
});
