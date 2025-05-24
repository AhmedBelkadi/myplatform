<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/permissions/assign', [PermissionController::class, 'assignForm'])->name('permissions.assign-form');
    Route::post('/permissions/assign', [PermissionController::class, 'assign'])->name('permissions.assign');
});
