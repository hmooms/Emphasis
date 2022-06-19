<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Inertia\Inertia;
use App\Models\Project;


class DashboardController extends Controller
{
    public function index()
    {
        // as admin you can see all the projects
        if (Auth::user()->is_admin){
            return Inertia::render('Dashboard', [
                'projects' => Project::orderBy('is_completed')->orderBy('end_date')->get()
            ]);
        } else {
            return Inertia::render('Dashboard', [
                'projects' => Auth::user()->projects()->orderBy('is_completed')->orderBy('end_date')->get()
            ]);
        }
    }
}
