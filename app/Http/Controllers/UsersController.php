<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class UsersController extends Controller
{
    public function index() 
    {
        return Inertia::render('Users/Index',[
            'users' => User::all()->map(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'isAdmin' => $user->isAdmin
            ]),
            'can' => [
                'seeUsers' => Auth::user()->isAdmin
            ]
        ]);
    }
}
