<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('non-authenticated user cannot access the personalized dashboard', function () {
    $response = $this->get(route('personalized.dashboard'));

    $response->assertRedirect(route('login'));
});

test('non-authenticated user receives method not allowed on invalid requests', function () {
    $response = $this->post(route('personalized.dashboard'), [
        'action' => 'fetch-data',
    ]);

    $response->assertStatus(405); // Method not allowed
});
test('non-authenticated user cannot access personalized dashboard API endpoints', function () {
    $response = $this->json('GET', route('personalized.dashboard'));

    $response->assertUnauthorized(); // Ensures it responds with a 401 Unauthorized
});
