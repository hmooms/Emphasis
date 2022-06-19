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
            'users' => User::where('is_admin', false)->get()
        ]);
    }

    public function store(Request $request)
    {
        // validate
        $validated = $request->validate([
            'title' => 'required|max:100',
            'description' => 'required|max:300',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'customer' => 'nullable|string|max:50',
            'contact' => 'required|string|max:30',
            'contact_phone' => 'required|string|max:15',
            'contact_email' => 'required|email|max:50'
        ]);
        // validate the team members
        $validatedUsers = $request->validate([
            'team' => 'required|array|min:1',
            'team.*' =>  'exists:users,id'
        ]);

        // create new project
        $project = new Project($validated);
        
        // save to db
        $project->save();
        
        // attach the team members
        foreach ($validatedUsers["team"] as $teamMember){
            $project->users()->attach($teamMember);
        }

        // go back to dashboard
        return redirect('Dashboard');
    }
}
