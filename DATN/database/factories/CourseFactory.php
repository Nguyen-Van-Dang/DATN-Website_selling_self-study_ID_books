<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Course;
use App\Models\CourseCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;
    public function definition()
    {

        return [
            'name' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'discount' => $this->faker->numberBetween(0, 50),
            'amount_lecture' => $this->faker->numberBetween(1, 50),
            'description' => $this->faker->paragraph(3),
            'image_url' => $this->faker->imageUrl(),
            'status' => 0,
            'user_id' => User::inRandomOrder()->first()->id,
            'course_categories_id' => CourseCategories::inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}