<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'status' => Arr::random(['pending', 'delivered']),
            'delivered_at' => now()->addDays(random_int(4, 9)),
        ];
    }
}
