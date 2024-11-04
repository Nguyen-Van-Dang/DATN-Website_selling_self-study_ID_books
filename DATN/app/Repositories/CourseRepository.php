<?php

namespace App\Repositories;
use App\Models\Courses;

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
        $Course = Courses::getAll();
        return view('admin.course.listCourse', ['Course' => $Course]);
    }
}
