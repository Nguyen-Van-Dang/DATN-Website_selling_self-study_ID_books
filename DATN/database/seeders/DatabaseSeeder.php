<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCategories;
use App\Models\CourseCategories;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Favorite;
use App\Models\Image;
use App\Models\Lecture;
use App\Models\LectureCategories;
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
        DB::statement('ALTER TABLE lecture_categories AUTO_INCREMENT = 1;');


        Role::create(['id' => 1, 'name' => 'Admin']);
        Role::create(['id' => 2, 'name' => 'Teacher']);
        Role::create(['id' => 3, 'name' => 'Student']);
        $user = User::factory()->create(['role_id' => 1, 'phone' => '0123456789']);
        Image::create([
            'imageable_id' => $user->id,
            'imageable_type' => User::class,
            'image_url' => 'https://placehold.co/498x488',
            'image_name' => 'avatar',
        ]);
        $user = User::factory()->create(['role_id' => 2]);
        Image::create([
            'imageable_id' => $user->id,
            'imageable_type' => User::class,
            'image_url' => 'https://placehold.co/498x488',
            'image_name' => 'avatar',
        ]);
        $user = User::factory()->create(['role_id' => 3]);
        Image::create([
            'imageable_id' => $user->id,
            'imageable_type' => User::class,
            'image_url' => 'https://placehold.co/498x488',
            'image_name' => 'avatar',
        ]);
        $users = User::factory(12)->create();
        $users->each(function ($user) {
            Image::create([
                'imageable_id' => $user->id,
                'imageable_type' => User::class,
                'image_url' => 'https://placehold.co/498x488',
                'image_name' => 'avatar',
            ]);
        });
        Contact::factory(15)->create();
        PaymentMethods::factory()->create(['id' => 1, 'name' => 'momo']);
        PaymentMethods::factory()->create(['id' => 2, 'name' => 'vnpay']);
        Order::factory(15)->create();
        CourseCategories::factory(15)->create();

        $courses = Course::factory(15)->create();
        foreach ($courses as $course) {
            Image::create([
                'imageable_id' => $course->id,
                'imageable_type' => Course::class,
                'image_url' => 'https://placehold.co/771x488',
                'image_name' => 'course'
            ]);
        }
        BookCategories::factory(15)->create();
        $books = Book::factory(30)->create();
        foreach ($books as $book) {
            Image::create([
                'imageable_id' => $book->id,
                'imageable_type' => Book::class,
                'image_url' => 'https://placehold.co/498x738',
                'image_name' => 'thumbnail'
            ]);
            for ($i = 1; $i <= 4; $i++) {
                Image::create([
                    'imageable_id' => $book->id,
                    'imageable_type' => Book::class,
                    'image_url' => 'https://placehold.co/498x738',
                    'image_name' => 'gallery'
                ]);
            }
        }
        LectureCategories::factory(15)->create();
        Lecture::factory(15)->create();

        $Books = Book::all();
        $BookCategories = BookCategories::all();
        foreach ($Books as $book) {
            $randomCategories = $BookCategories->random(rand(1, 6))->pluck('id');

            foreach ($randomCategories as $categoryId) {
                DB::table('book_categories_mapping')->insert([
                    'book_id' => $book->id,
                    'category_id' => $categoryId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
