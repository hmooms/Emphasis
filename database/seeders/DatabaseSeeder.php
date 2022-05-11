<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@account.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'phone' => '0612341234',
            'remember_token' => Str::random(10),
            'isAdmin' => true,
        ]);
    }
}
