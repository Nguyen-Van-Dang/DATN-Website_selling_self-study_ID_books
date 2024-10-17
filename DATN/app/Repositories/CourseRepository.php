<?php

namespace App\Repositories;
use App\Models\Course;

class CourseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllCourse() {
        $Course = Course::getAll();
        return view('admin.course.listCourse', ['Course' => $Course]);
    }
}
