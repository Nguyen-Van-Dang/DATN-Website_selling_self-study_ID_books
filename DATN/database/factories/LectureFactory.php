<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\LectureCategories;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'course_id' => Course::inRandomOrder()->first()->id,
            'lecture_categories_id' => LectureCategories::inRandomOrder()->first()->id,

        ];
    }
}
