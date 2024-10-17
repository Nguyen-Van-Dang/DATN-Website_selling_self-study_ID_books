<?php

namespace App\Repositories;

use App\Models\CategoryCourse;

class CourseCateRepository
{
    public function __construct()
    {
        //
    }

    public function getAllCourseCate() {
        $courseCate = CategoryCourse::getAll();
        return view('admin.categoryCourse.listCategoryCourse', ['courseCate' => $courseCate]);
    }
}
