<?php

use Laravel\Jetstream\Http\Controllers\Inertia\UserProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('admin')->group(function () {
    // user routes
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/user/create', [UsersController::class, 'create'])->name('user.create');
    Route::post('/user', [UsersController::class, 'store']);
    Route::get('/user/profile/{id}', [UsersController::class, 'show']);
    Route::delete('/user', [UsersController::class, 'delete'])->name('user.delete')->middleware('confirm.password');

    // project routes
    Route::get('/project/create', [ProjectsController::class, 'create'])->name('project.create');
    Route::post('/project', [ProjectsController::class, 'store'])->name('project.store');
    Route::delete('/project', [ProjectsController::class, 'delete'])->name('project.delete')->middleware('confirm.password');
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // user routes
    Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::put('/user/{id}', [UsersController::class, 'updateProfile'])->middleware('user.or.admin');
    
    // project routes
    Route::get('/project/{id}', [ProjectsController::class, 'show'])->name('project.show')->middleware('member.or.admin');
    Route::put('/project/{id}', [ProjectsController::class, 'update'])->name('project.update')->middleware('member.or.admin');
});

// I require the fortify routes because i disabled them in the fortifyprovider 
require_once __DIR__ . '/fortify.php';
