<?php

use App\Models\User;

test('home page is accessible', function () {
    $response = $this->get('/home');
    $response->assertOk(); // Ensure the route returns a 200 status
});

test('home page requires authentication', function () {
    $response = $this->get('/home');
    $response->assertRedirect('/login'); // Ensure it redirects to login if unauthenticated
});

test('authenticated user can see the home page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/home');
    $response->assertOk()
             ->assertSee('Welcome to the Home Page'); // Check if page content is correct
});

