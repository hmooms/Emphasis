<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Project;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        
        Project::factory(5)->create();

        // create admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@account.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '0612341234',
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        // create completed project
        DB::table('projects')->insert([
            'title' => 'completed project',
            'description' => 'A great invention to solve the worlds biggest problem, bad internet speed',
            'customer' => 'Customer Company',
            'contact' => 'Company contact',
            'contact_phone' => '04729385739',
            'contact_email' => 'contact@company.com',
            'start_date' => new \DateTime(date('m/d/Y H:i:s', strtotime("-3 week"))),
            'end_date' => new \DateTime(date('m/d/Y H:i:s', strtotime("-3 day"))),
            'is_completed' => true
        ]);

        DB::table('projects')->insert([
            'title' => 'overdue project',
            'description' => 'kinda slow project',
            'customer' => 'Customer Company',
            'contact' => 'Company contact',
            'contact_phone' => '04729385739',
            'contact_email' => 'contact@company.com',
            'start_date' => new \DateTime(date('m/d/Y H:i:s', strtotime("-3 week"))),
            'end_date' => new \DateTime(date('m/d/Y H:i:s', strtotime("-3 day"))),
            'is_completed' => false
        ]);

        $users = User::where('is_admin', false)->get();


        // itterate over each project and add a random user
        Project::all()->each(function($project) use ($users) {
            $project->users()->attach(
                $users->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

    }
}
