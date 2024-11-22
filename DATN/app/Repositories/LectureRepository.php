<?php

namespace App\Repositories;

use App\Models\Lecture;
use App\Models\Course;

class LectureRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function showLecture($course_id, $lecture_id)
    {
        // Tìm khóa học theo course_id
        $course = Course::findOrFail($course_id);
        
        // Tìm bài giảng theo lecture_id
        $lecture = Lecture::findOrFail($lecture_id);
        
        // Trả về view và truyền dữ liệu khóa học và bài giảng
        return view('client.lecture.lecture', compact('course', 'lecture'));
    }
    
    
}
