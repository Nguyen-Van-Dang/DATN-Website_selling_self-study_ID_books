<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('comments')->insert([
            ['comment_id' => 1, 'user_id' => 1, 'content' => 'Cuốn sách này thật tuyệt vời!', 'commentable_type' => 'Book', 'commentable_id' => 1, 'parent_id' => null, 'created_at' => now()],
            ['comment_id' => 2, 'user_id' => 2, 'content' => 'Đúng rồi, mình cũng thấy vậy!', 'commentable_type' => 'Book', 'commentable_id' => 1, 'parent_id' => 1, 'created_at' => now()],
            
            ['comment_id' => 3, 'user_id' => 1, 'content' => 'Bài giảng này rất dễ hiểu!', 'commentable_type' => 'Lesson', 'commentable_id' => 1, 'parent_id' => null, 'created_at' => now()],
            ['comment_id' => 4, 'user_id' => 3, 'content' => 'Mình cần thêm ví dụ về Routing.', 'commentable_type' => 'Lesson', 'commentable_id' => 1, 'parent_id' => 3, 'created_at' => now()],
            
            ['comment_id' => 6, 'user_id' => 3, 'content' => 'Khóa học này rất hữu ích cho người mới bắt đầu.', 'commentable_type' => 'Course', 'commentable_id' => 1, 'parent_id' => null, 'created_at' => now()],
            ['comment_id' => 7, 'user_id' => 4, 'content' => 'Mình đã học được rất nhiều từ khóa học này.', 'commentable_type' => 'Course', 'commentable_id' => 1, 'parent_id' => 6, 'created_at' => now()],
        ]);
    }
}


