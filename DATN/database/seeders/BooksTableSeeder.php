<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            ['title' => 'Learn Laravel', 'author' => 'John Doe', 'created_at' => now()],
            ['title' => 'Mastering PHP', 'author' => 'Jane Smith', 'created_at' => now()],
        ]);
    }
}

