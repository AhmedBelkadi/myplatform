<?php

use App\Http\Controllers\Support\SupportDashboardController;
use App\Http\Controllers\Support\SupportTicketController;
use App\Http\Controllers\Support\SupportProfileController;
use Illuminate\Support\Facades\Route;

// SUPPORT ROUTES
Route::middleware(['auth', 'role:Support'])->prefix('support')->name('support.')->group(function () {
    Route::get('/dashboard', [SupportDashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:view_support_dashboard');

    Route::middleware('permission:view_all_tickets')->group(function () {
        Route::get('/tickets', [SupportTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [SupportTicketController::class, 'show'])->name('tickets.show');
    });

    Route::post('/tickets/{ticket}/reply', [SupportTicketController::class, 'reply'])
        ->name('tickets.reply')
        ->middleware('permission:reply_ticket');

    Route::post('/tickets/{ticket}/resolve', [SupportTicketController::class, 'resolve'])
        ->name('tickets.resolve')
        ->middleware('permission:close_ticket');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [SupportProfileController::class, 'show'])->name('show')->middleware('permission:view_profile');
        Route::put('/', [SupportProfileController::class, 'update'])->name('update')->middleware('permission:update_profile');
        Route::put('/password', [SupportProfileController::class, 'updatePassword'])->name('password')->middleware('permission:update_password');
    });
});
