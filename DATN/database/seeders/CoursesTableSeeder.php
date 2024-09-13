<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('courses')->insert([
            ['title' => 'Laravel for Beginners', 'description' => 'A complete guide to Laravel basics', 'created_at' => now()],
            ['title' => 'Advanced PHP Techniques', 'description' => 'Master advanced PHP features', 'created_at' => now()],
        ]);
    }
}
