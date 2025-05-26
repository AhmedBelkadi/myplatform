<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('master');
})->name('home');

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/support.php';
require __DIR__ . '/admin.php';
