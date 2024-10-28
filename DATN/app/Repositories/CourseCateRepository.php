<?php

namespace App\Repositories;

use App\Models\CourseCategories;

class CourseCateRepository
{
    public function __construct()
    {
        //
    }

    public function getAllCourseCate() {
        $courseCate = CourseCategories::getAll();
        return view('admin.categoryCourse.listCategoryCourse', ['courseCate' => $courseCate]);
    }
}
