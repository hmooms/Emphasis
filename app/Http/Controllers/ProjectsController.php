<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectsController extends Controller
{
    public function create()
    {
        return Inertia::render('Project/Create');
    }

    public function store(Request $request)
    {
        // validate

        // store

        return redirect('Dashboard');
    }
}
