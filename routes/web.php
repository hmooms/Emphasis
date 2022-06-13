<?php

use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('admin')->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/user/create', [UsersController::class, 'create'])->name('user-create');
    Route::post('/user', [UsersController::class, 'store']);
    Route::get('/user/profile/{id}', [UsersController::class, 'show']);
    Route::delete('/user', [UsersController::class, 'delete'])->name('user-delete')->middleware('confirm.password');
});


Route::middleware([
    'auth:sanctum',
])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');

    Route::put('/user/{id}', [UsersController::class, 'updateProfile'])->name('updateProfile');
});


require_once __DIR__ . '/fortify.php';
