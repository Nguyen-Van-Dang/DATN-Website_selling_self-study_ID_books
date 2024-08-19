<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Role;
use App\Models\User;
use App\Models\Notification;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory()->create(['id' => 1, 'name' => 'Quản lý']);
        Role::factory()->create(['id' => 2, 'name' => 'Giảng viên']);
        Role::factory()->create(['id' => 3, 'name' => 'Sinh viên']);
        User::factory(10)->create();
        Order::factory(5)->create();
        Payment::factory(10)->create();
        Notification::factory(10)->create();
    }
}
