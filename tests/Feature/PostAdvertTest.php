<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;



test('guest cannot post an advert', function () {
    // Act: Post an advert without authentication
    $response = $this->post(route('products.store'), []);

    // Assert: Ensure the guest is redirected to login
    $response->assertRedirect(route('login'));
});
