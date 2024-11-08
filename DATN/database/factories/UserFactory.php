<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = 'password';  // Đặt mật khẩu mặc định

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Kiểm tra nếu không có role nào, ta tạo một role ngẫu nhiên
        $roleId = Role::inRandomOrder()->first()?->id ?? Role::factory()->create()->id;

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make(self::$password),
            'phone' => '0' . $this->faker->numberBetween(100000000, 999999999),
            'role_id' => $roleId,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Thiết lập phương thức để tạo role mới nếu chưa có role nào.
     */
    public static function withRole(): static
    {
        return static::state(function (array $attributes) {
            // Tạo một Role mới nếu chưa có dữ liệu trong bảng roles
            $role = Role::firstOrCreate(['name' => 'user']); // Giả sử bạn muốn tạo một role mặc định là "user"
            return [
                'role_id' => $role->id,
            ];
        });
    }
}
