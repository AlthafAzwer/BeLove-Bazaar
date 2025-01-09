<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'sender_id' => User::factory(),      // Create a user as the sender
            'receiver_id' => User::factory(),   // Create a user as the receiver
            'content' => $this->faker->sentence,
            'product_name' => $this->faker->word,  // Optional, depending on your database schema
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
