<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SupportProfileController;
use App\Http\Controllers\UserProfileController;

// Public routes
Route::get('/', function () {
    return view('master');
})->name('home');

// Auth routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// User Routes
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

// Support Routes
Route::prefix('support')->name('support.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\SupportDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tickets', [SupportTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [SupportTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [SupportTicketController::class, 'reply'])->name('tickets.reply');
    Route::post('/tickets/{ticket}/resolve', [SupportTicketController::class, 'resolve'])->name('tickets.resolve');
    Route::get('/profile', [SupportProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [SupportProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [SupportProfileController::class, 'updatePassword'])->name('profile.password');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
    Route::resource('permissions', PermissionController::class);
    Route::put('/permissions/{permission}/roles', [PermissionController::class, 'assignRoles'])->name('permissions.assign-roles');
    Route::get('/tickets', [AdminTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [AdminTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/assign', [AdminTicketController::class, 'assign'])->name('tickets.assign');
    Route::put('/tickets/{ticket}/close', [AdminTicketController::class, 'close'])->name('tickets.close');
});



