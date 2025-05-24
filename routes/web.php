<?php


require __DIR__ . '/dashboard.php';
require __DIR__ . '/profile.php';
require __DIR__ . '/auth.php'; // Laravel Breeze/Auth default routes
require __DIR__ . '/auth-custom.php';
require __DIR__ . '/home.php';

// Admin route groups
require __DIR__ . '/admin/roles.php';
require __DIR__ . '/admin/permissions.php';
require __DIR__ . '/admin/users.php';











//use App\Http\Controllers\Admin\RoleController;
//use App\Http\Controllers\ProfileController;
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PermissionController;
//use App\Http\Controllers\Admin\UserController;
//
//
//use Illuminate\Support\Facades\Auth;
//
//Route::get('/dashboard', function () {
//    $user = Auth::user(); // récupère l'utilisateur connecté
//    return view('auth.dashboard', compact('user'));
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});
//
//// Admin Routes (roles)
//Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
//    // Rôles
//    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
//    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
//    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
//    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit'); // Route pour modifier un rôle
//    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
//    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
//
//    // Permissions
//    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
//    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
//
//    // Assignation des permissions à un rôle
//    Route::get('/permissions/assign', [PermissionController::class, 'assignForm'])->name('permissions.assign-form');
//    Route::post('/permissions/assign', [PermissionController::class, 'assign'])->name('permissions.assign');
//
//    //users
//    Route::get('/users', [UserController::class, 'index'])->name('users.index');
//    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
//    Route::post('/users', [UserController::class, 'store'])->name('users.store');
//    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
//    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
//    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
//    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
//
//});
//
//
//Route::post('/logout', function () {
//    Auth::logout();
//    request()->session()->invalidate();
//    request()->session()->regenerateToken();
//    return redirect('/login');
//})->name('logout');
//require __DIR__.'/auth.php';
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
