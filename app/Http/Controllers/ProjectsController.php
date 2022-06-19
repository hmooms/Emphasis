<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Project;
use App\Models\User;


class ProjectsController extends Controller
{
    public function create()
    {
        return Inertia::render('Project/Create', [
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        // validate

        // store

        return redirect('Dashboard');
    }
}
