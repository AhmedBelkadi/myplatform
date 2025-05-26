<?php

use App\Http\Controllers\Support\SupportDashboardController;
use App\Http\Controllers\Support\SupportTicketController;
use App\Http\Controllers\Support\SupportProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('support')->name('support.')->group(function () {
    Route::get('/dashboard', [SupportDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tickets', [SupportTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [SupportTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [SupportTicketController::class, 'reply'])->name('tickets.reply');
    Route::post('/tickets/{ticket}/resolve', [SupportTicketController::class, 'resolve'])->name('tickets.resolve');

    Route::get('/profile', [SupportProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [SupportProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [SupportProfileController::class, 'updatePassword'])->name('profile.password');
});
