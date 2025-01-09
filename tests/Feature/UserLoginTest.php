<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_valid_credentials()
    {
        // Arrange: Create a test user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Act: Send a login request
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert: Check the response and authentication status
        $response->assertStatus(302); // Redirect after successful login
        $response->assertRedirect('/dashboard'); // Redirect to dashboard
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        // Arrange: Create a test user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Act: Attempt login with incorrect password
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrong-password',
        ]);

        // Assert: Check response and authentication status
        $response->assertStatus(302); // Redirect after failed login
        $response->assertSessionHasErrors(['email']); // Check for validation errors
        $this->assertGuest(); // Ensure no user is authenticated
    }
}

