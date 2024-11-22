<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CourseRepository;
use App\Models\User;
use App\Models\Lecture;
use App\Models\LectureCategories;
use Illuminate\Support\Facades\Auth;
class CourseController extends Controller
{
    private CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    public function getAllCourse()
    {
        return $this->courseRepository->getAllCourse();
    }

    public function index()
    {
        return view('admin.course.listCourse');
    }

    public function create()
    {
        return $this->courseRepository->create();
    }
    public function edit($id)
    {
        return $this->courseRepository->edit($id);
    }
}
