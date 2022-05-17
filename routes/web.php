<?php

use App\Http\Controllers\UsersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('admin')->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard', [
            'can' => [
                'seeUsers' => Auth::User()->isAdmin
            ]
        ]);
    })->name('dashboard');
});
