<?php

use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('authenticated user can create an order for a product', function () {
    // Arrange: Create a seller, product, and authenticate a buyer
    $seller = User::factory()->create();
    $product = Product::factory()->create(['user_id' => $seller->id]);

    $buyer = User::factory()->create();
    $this->actingAs($buyer);

    $data = [
        'buyer_name' => 'John Doe',
        'buyer_address' => '123 Main Street',
        'buyer_telephone' => '0771234567',
        'payment_method' => 'Cash',
    ];

    // Act: Post the order
    $response = $this->post(route('orders.store', $product->id), $data);

    // Assert: Check the response and database
    $response->assertRedirect(route('buyer.orders'));
    $response->assertSessionHas('success', 'Order placed successfully.');

    $this->assertDatabaseHas('orders', [
        'product_id' => $product->id,
        'buyer_id' => $buyer->id,
        'buyer_name' => 'John Doe',
        'buyer_address' => '123 Main Street',
        'buyer_telephone' => '0771234567',
        'payment_method' => 'Cash',
        'status' => 'Pending',
    ]);
});

test('validation errors are returned when required fields are missing for order creation', function () {
    // Arrange: Create a seller, product, and authenticate a buyer
    $seller = User::factory()->create();
    $product = Product::factory()->create(['user_id' => $seller->id]);

    $buyer = User::factory()->create();
    $this->actingAs($buyer);

    // Act: Post the order with missing fields
    $response = $this->post(route('orders.store', $product->id), []);

    // Assert: Check for validation errors
    $response->assertSessionHasErrors([
        'buyer_name',
        'buyer_address',
        'buyer_telephone',
        'payment_method',
    ]);
});

test('guest cannot create an order', function () {
    // Arrange: Create a product
    $seller = User::factory()->create();
    $product = Product::factory()->create(['user_id' => $seller->id]);

    // Act: Post an order without authentication
    $response = $this->post(route('orders.store', $product->id), []);

    // Assert: Ensure the guest is redirected to login
    $response->assertRedirect(route('login'));
});

test('seller can view their orders', function () {
    // Arrange: Create a seller, product, and orders
    $seller = User::factory()->create();
    $product = Product::factory()->create(['user_id' => $seller->id]);

    Order::factory()->count(3)->create(['product_id' => $product->id]);

    $this->actingAs($seller);

    // Act: Get the seller orders page
    $response = $this->get(route('seller.orders'));

    // Assert: Ensure the orders are visible
    $response->assertOk();
    $response->assertViewHas('orders');
});

test('authenticated user can update their order status', function () {
    // Arrange: Create a seller, product, and an order
    $seller = User::factory()->create();
    $product = Product::factory()->create(['user_id' => $seller->id]);
    $order = Order::factory()->create(['product_id' => $product->id]);

    $this->actingAs($seller);

    $data = ['status' => 'Shipped'];

    // Act: Update the order status
    $response = $this->patch(route('orders.update', $order->id), $data);

    // Assert: Check the response and database
    $response->assertRedirect(route('seller.orders'));
    $response->assertSessionHas('success', 'Order status updated.');

    $this->assertDatabaseHas('orders', [
        'id' => $order->id,
        'status' => 'Shipped',
    ]);
});

test('unauthorized user cannot update order status', function () {
    // Arrange: Create a seller, product, and an order
    $seller = User::factory()->create();
    $product = Product::factory()->create(['user_id' => $seller->id]);
    $order = Order::factory()->create(['product_id' => $product->id]);

    $unauthorizedUser = User::factory()->create();
    $this->actingAs($unauthorizedUser);

    $data = ['status' => 'Shipped'];

    // Act: Attempt to update the order status
    $response = $this->patch(route('orders.update', $order->id), $data);

    // Assert: Ensure unauthorized action is prevented
    $response->assertRedirect(route('seller.orders'));
    $response->assertSessionHas('error', 'Unauthorized action.');

    $this->assertDatabaseMissing('orders', [
        'id' => $order->id,
        'status' => 'Shipped',
    ]);
});
