<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Inertia\Inertia;


class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'projects' => Auth::user()->projects()->orderBy('is_completed')->orderBy('end_date')->get()
        ]);
    }
}
