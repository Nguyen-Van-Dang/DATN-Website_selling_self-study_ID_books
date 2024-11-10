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
    public function showLecture($id)
    {

        return view('client.lecture.lecture', compact('course', 'lecture'));
    }
}
