<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('home page is accessible', function () {
    $response = $this->get('/home');
    $response->assertRedirect('/login'); // Ensure unauthenticated access redirects to login
});


