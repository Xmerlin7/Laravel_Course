<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $amount = fake()->randomFloat(2, 150, 1500);

        return [
            'user_id' => null,
            'order_number' => 'ORD-' . fake()->unique()->numerify('########'),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'status' => fake()->randomElement(['pending', 'processing', 'completed']),
            'subtotal' => $amount,
            'total' => $amount,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
