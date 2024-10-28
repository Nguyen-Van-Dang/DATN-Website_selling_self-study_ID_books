<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'user_id' => User::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            
        ];
    }
}
