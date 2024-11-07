<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;

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
        return view('client.course.courses');
    }
    public function show($id)
    {
        return $this->courseRepository->getCourseById($id);
    }
}
