<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    $user = Auth::user();
    return view('auth.dashboard', compact('user'));
// })->middleware(['auth', 'verified'])->name('dashboard');
})->name('dashboard');
