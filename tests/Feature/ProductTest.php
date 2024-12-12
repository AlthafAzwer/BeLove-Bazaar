<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('allows authenticated users to create a product', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
         ->post('/products', [
             'title' => 'Test Product',
             'price' => 1500,
             'category' => 'Electronics',
             'description' => 'Test product description.',
         ])
         ->assertRedirect('/products');

    $this->assertDatabaseHas('products', ['title' => 'Test Product']);
});
