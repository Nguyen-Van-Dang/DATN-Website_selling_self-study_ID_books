<?php

namespace Database\Factories;

use App\Models\BookCategories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'page_number' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->paragraph(3),
            'quantity' => $this->faker->numberBetween(1000, 2000),
            'user_id' => User::inRandomOrder()->first()->id,
            'discount' => $this->faker->randomFloat(2, 0, 90),
        ];
    }
}
