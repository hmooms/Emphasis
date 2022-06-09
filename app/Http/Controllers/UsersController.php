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
            'users' => User::orderBy('is_admin', 'desc')->orderBy('name')->select('id', 'name', 'email', 'phone', 'is_admin')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {

        //  validate
        $validated = $request->validate([
            'email' => 'required|unique:users|max:255|email',
            'name' => 'required|max:255',
            'phone' => 'required|max:15|unique:users',
            'is_admin' => 'boolean',
            'password' => 'required|max:16'
        ]);
        // create a user
        $user = new User($validated);
        // create tmp password

        
        $user->encryptPassword();

        // save to db
        $user->save();
        // if success go to users page
        return redirect('users');
    }

    public function updateProfile(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'required|max:255|email|unique:users,email,'.$id,
            'name' => 'required|max:255',
            'phone' => 'required|max:15|unique:users,phone,'.$id
        ]);
        User::find($id)->update($validated);
        // $user->update($validated);

        return redirect(route('profile.show'));
    }

    public function delete(Request $request)
    {
        User::find($request->id)->delete();

        return redirect('users');
    }
}