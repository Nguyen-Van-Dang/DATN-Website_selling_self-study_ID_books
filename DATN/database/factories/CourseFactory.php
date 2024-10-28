<?php

namespace Database\Factories;

use App\Models\CourseCategories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'amount_lecture' => $this->faker->numberBetween(1, 50),
            'description' => $this->faker->paragraph(3),
            'image_url' => $this->faker->imageUrl(),
            'user_id' => User::inRandomOrder()->first()->id,
            'course_categories_id' => CourseCategories::inRandomOrder()->first()->id,
        ];
    }
}
