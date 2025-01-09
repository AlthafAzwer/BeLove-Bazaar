<?php

use App\Models\User;
use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('non-authenticated user cannot send a message', function () {
    $receiver = User::factory()->create();

    $response = $this->post(route('messages.store', $receiver->id), [
        'content' => 'Hello, this is a test message!',
    ]);

    $response->assertRedirect(route('login'));
    $this->assertDatabaseMissing('messages', [
        'receiver_id' => $receiver->id,
        'content' => 'Hello, this is a test message!',
    ]);
});

test('non-authenticated user cannot access the /messages route', function () {
    $response = $this->get(route('messages.index'));

    $response->assertRedirect(route('login'));
});

test('non-authenticated user cannot access the /messages/{id} route', function () {
    $receiver = User::factory()->create();

    $response = $this->get(route('messages.show', $receiver->id));

    $response->assertRedirect(route('login'));
});

test('non-authenticated user cannot delete messages', function () {
    $receiver = User::factory()->create();
    $message = Message::factory()->create([
        'sender_id' => $receiver->id,
    ]);

    $response = $this->delete(route('messages.deleteChat', $receiver->id));

    $response->assertRedirect(route('login'));
    $this->assertDatabaseHas('messages', [
        'id' => $message->id,
    ]);
});
