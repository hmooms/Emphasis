<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Project;
use App\Models\User;
use Auth;


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
        return redirect(route('dashboard'));
    }

    public function show($id)
    {
        return Inertia::render('Project/Show', [
            'project' => Project::with('users')->where('id', $id)->first(),
            'team' => Project::find($id)->users->pluck("id")->toArray(),
            'users' => User::where('is_admin', false)->get()
        ]);
    }

    public function update(Request $request, $id)
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
    
        // find and update project
        $project = Project::find($id);
        $project->update($validated);

        // checks if any of the previously attached users are removed from project 
        // (If they aren't in the team array then it means they have been removed)
        foreach($project->users->pluck('id') as $user) {
            if (!in_array($user, $validatedUsers["team"])) {
                $project->users()->detach($user);
            }
        }

        // check if the selected users were not already attached to the project 
        // only attach those that were not already attached
        foreach ($validatedUsers["team"] as $user){
            if (!in_array($user, $project->users->pluck('id')->toArray())) {
                $project->users()->attach($user);
            }
        }
        // return back
        return back();
    }

    public function delete(Request $request)
    {
        Project::find($request->id)->delete();

        return redirect(route('dashboard'));
    }
}
