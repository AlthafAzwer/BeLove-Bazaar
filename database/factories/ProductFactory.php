<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Link to a user
            'category' => $this->faker->word,
            'title' => $this->faker->sentence,
            'condition' => $this->faker->randomElement(['New', 'Used']),
            'location' => $this->faker->city,
            'description' => $this->faker->paragraph,
            'contact_info' => $this->faker->phoneNumber,
            'price' => $this->faker->randomFloat(2, 100, 100000),
            'status' => 'pending', // Default status
        ];
    }
}
