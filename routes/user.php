<?php

use App\Http\Controllers\Utilisateur\TicketController;
use App\Http\Controllers\Utilisateur\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('tickets')->name('tickets.')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/create', [TicketController::class, 'create'])->name('create');
    Route::post('/', [TicketController::class, 'store'])->name('store');
    Route::get('/{ticket}', [TicketController::class, 'show'])->name('show');
    Route::post('/{ticket}/reply', [TicketController::class, 'reply'])->name('reply');
});

Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password');
