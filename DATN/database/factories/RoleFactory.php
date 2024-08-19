<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'id' => $this->faker->unique()->randomElement(['1', '2', '3']),
           'name' => $this->faker->unique()->randomElement(['Quản lý', 'Sinh viên', 'Giảng viên']),
           'description' => $this->faker->text(50),
        ];
    }
}
