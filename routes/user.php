<?php

use App\Http\Controllers\Utilisateur\TicketController;
use App\Http\Controllers\Utilisateur\UserProfileController;
use Illuminate\Support\Facades\Route;

// USER ROUTES
Route::middleware(['auth', 'role:Utilisateur'])->group(function () {
    Route::prefix('tickets')->name('tickets.')->group(function () {
        Route::middleware('permission:view_all_tickets')->group(function () {
            Route::get('/', [TicketController::class, 'index'])->name('index');
            Route::get('/{ticket}', [TicketController::class, 'show'])->name('show');
        });

        Route::middleware('permission:create_ticket')->group(function () {
            Route::get('/create', [TicketController::class, 'create'])->name('create');
            Route::post('/', [TicketController::class, 'store'])->name('store');
        });

        Route::post('/{ticket}/reply', [TicketController::class, 'reply'])->name('reply')->middleware('permission:reply_ticket');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [UserProfileController::class, 'show'])->name('show')->middleware('permission:view_profile');
        Route::put('/', [UserProfileController::class, 'update'])->name('update')->middleware('permission:update_profile');
        Route::put('/password', [UserProfileController::class, 'updatePassword'])->name('password')->middleware('permission:update_password');
    });
});
