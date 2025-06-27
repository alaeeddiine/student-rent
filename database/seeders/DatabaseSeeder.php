<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Announcement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create sample users
        $student = User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
        ]);

        $owner = User::factory()->create([
            'name' => 'Property Owner',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create sample properties
        Property::factory()->count(5)->create([
            'user_id' => $owner->id,
        ]);

        // Create sample announcements
        Announcement::factory()->count(3)->create([
            'user_id' => $student->id,
        ]);
    
    // Create 5 active announcements
    \App\Models\Announcement::factory()
        ->count(5)
        ->active()
        ->create();

    // Create 3 archived announcements
    \App\Models\Announcement::factory()
        ->count(3)
        ->archived()
        ->create();

    // Create 2 upcoming announcements
    \App\Models\Announcement::factory()
        ->count(2)
        ->upcoming()
        ->create();
}
}
\App\Models\Property::factory()
        ->count(10)
        ->create();