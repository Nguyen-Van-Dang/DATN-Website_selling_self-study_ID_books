<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\CategoryBook;
use App\Models\CourseCategories;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE orders AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE payments AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE notifications AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE contacts AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE course_categories AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE courses AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE category_books AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE books AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE lectures AUTO_INCREMENT = 1;');

        // Role::factory()->create(['id' => 1, 'name' => 'Quản lý']);
        // Role::factory()->create(['id' => 2, 'name' => 'Giảng viên']);
        // Role::factory()->create(['id' => 3, 'name' => 'Sinh viên']);
        // User::factory()->create(['role_id' => 1, 'phone' => 0123456789]);
        // User::factory()->create(['role_id' => '2']);
        // User::factory()->create(['role_id' => '3']);
        // User::factory(12)->create();
        Contact::factory(5)->create();
        Order::factory(5)->create();
        Payment::factory(5)->create();
        Notification::factory(5)->create();
        CourseCategories::factory(5)->create();
        Course::factory(5)->create();
        CategoryBook::factory(5)->create();
        Book::factory(5)->create();
        Lecture::factory(5)->create();
    }
}
