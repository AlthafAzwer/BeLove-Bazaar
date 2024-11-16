<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles by calling RolesTableSeeder
        $this->call(RolesTableSeeder::class);

        // Create a test user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),  // Set a password
        ]);

        // Attach a "buyer" role to the test user (change to other roles if needed)
        $role = Role::where('name', 'buyer')->first(); // Retrieve the "buyer" role
        if ($role) {
            $user->roles()->attach($role);
        }
    }
}
