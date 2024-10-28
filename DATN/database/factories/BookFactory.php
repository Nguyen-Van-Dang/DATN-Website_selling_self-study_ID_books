<?php

namespace Database\Factories;

use App\Models\CategoryBook;
use App\Models\Course;
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
            'page_number' => $this->faker->numberBetween(1, 50),
            'course_id' => Course::inRandomOrder()->first()->id,
            'description' => $this->faker->paragraph(3),
            'quantity' => $this->faker->numberBetween(1, 100),
            'book_activate_id' => $this->faker->numberBetween(1, 5),
            'book_active' => $this->faker->boolean() ? 1 : 0,
            'category_books_id' => CategoryBook::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
