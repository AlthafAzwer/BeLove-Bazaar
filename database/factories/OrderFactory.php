<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(), // Creates a new product for the order
            'buyer_id' => User::factory(), // Creates a new user as the buyer
            'buyer_name' => $this->faker->name,
            'buyer_address' => $this->faker->address,
            'buyer_telephone' => $this->faker->phoneNumber,
            'payment_method' => $this->faker->randomElement(['Cash', 'Credit Card', 'Bank Transfer']),
            'status' => $this->faker->randomElement(['Pending', 'Shipped', 'Completed']),
        ];
    }
}
