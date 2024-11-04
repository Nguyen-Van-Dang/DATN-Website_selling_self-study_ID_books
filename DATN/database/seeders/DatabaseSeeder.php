<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCategories;
use App\Models\CourseCategories;
use App\Models\Contact;
use App\Models\Courses;
use App\Models\Lecture;
use App\Models\Order;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\PaymentMethods;
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
        DB::statement('ALTER TABLE payment_methods AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE notifications AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE contacts AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE course_categories AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE courses AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE book_categories AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE books AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE lectures AUTO_INCREMENT = 1;');

        Role::factory()->create(['name' => 'Quản lý']);
        Role::factory()->create(['name' => 'Giảng viên']);
        Role::factory()->create(['name' => 'Sinh viên']);
        User::factory()->create(['role_id' => 1, 'phone' => '0123456789']);
        User::factory()->create(['role_id' => 2]);
        User::factory()->create(['role_id' => 3]);
        User::factory(12)->create();
        Contact::factory(15)->create();
        PaymentMethods::factory(15)->create();
        Order::factory(15)->create();
        Notification::factory(15)->create();
        NotificationUser::factory(15)->create();
        CourseCategories::factory(15)->create();
        Courses::factory(15)->create();
        BookCategories::factory(15)->create();
        Book::factory(15)->create();
        Lecture::factory(15)->create();
    }
}
