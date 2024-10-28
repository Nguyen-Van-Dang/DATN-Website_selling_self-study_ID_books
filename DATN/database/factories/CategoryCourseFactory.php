<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryCourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
