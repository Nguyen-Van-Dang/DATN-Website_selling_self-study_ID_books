<?php

namespace Database\Factories;

use App\Models\PaymentMethods;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'user_id' => User::factory(), // Sử dụng factory để tạo người dùng
            'user_phone' => '0' . $this->faker->numberBetween(100000000, 999999999),
            'user_name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'payment_methods_id' => PaymentMethods::factory(), // Sử dụng factory để tạo phương thức thanh toán
        ];
    }
}
