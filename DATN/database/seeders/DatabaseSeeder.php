<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookCategories;
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
use App\Models\PaymentMethods;
use Illuminate\Support\Facades\Hash;
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
        DB::statement('ALTER TABLE courses AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE book_categories AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE books AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE lectures AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE lecture_categories AUTO_INCREMENT = 1;');
        // Role
        Role::create(['id' => 1, 'name' => 'Admin']);
        Role::create(['id' => 2, 'name' => 'Teacher']);
        Role::create(['id' => 3, 'name' => 'Student']);
        //User
        User::factory()->create(['role_id' => 1, 'name' => 'Admin', 'phone' => '0123456789', 'password' => Hash::make('Admin123'), 'email' => 'admin@gmail.com']);
        User::factory()->create(['role_id' => 2, 'name' => 'Teacher', 'phone' => '0123456788', 'password' => Hash::make('Teacher123'), 'email' => 'teacher@gmail.com']);
        User::factory()->create(['role_id' => 3, 'name' => 'Student', 'phone' => '0123456787', 'password' => Hash::make('Student123'), 'email' => 'student@gmail.com']);
        $users = User::factory(7)->create();
        $users->each(function ($user) {
            Image::create([
                'imageable_id' => $user->id,
                'imageable_type' => User::class,
                'image_url' => 'https://placehold.co/498x488',
                'image_name' => 'avatar',
            ]);
        });
        //Payment
        PaymentMethods::factory()->create(['id' => 1, 'name' => 'momo']);
        PaymentMethods::factory()->create(['id' => 2, 'name' => 'vnpay']);
        //Oder
        Order::factory(15)->create();
        $courses = Course::factory(15)->create();
        foreach ($courses as $course) {
            Image::create([
                'imageable_id' => $course->id,
                'imageable_type' => Course::class,
                'image_url' => 'https://placehold.co/771x488',
                'image_name' => 'course'
            ]);
        }
        //BookCategories
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
            //LectureCategories
            LectureCategories::factory(15)->create();
            //Lecture        
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
            $this->call([
                ClassSeeder::class,
                SubjectSeeder::class,
            ]);
        }
    }