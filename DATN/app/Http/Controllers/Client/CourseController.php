<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Lecture;

class CourseController extends Controller
{
    private CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }
    public function index()
    {
        return view('client.course.courses');
    }
    public function show($id)
    {
        return $this->courseRepository->getCourseById($id);
    }
    public function detail($course_id, $lecture_id)
    {

        $course = Course::with(['lectures.lectureCategory'])->findOrFail($course_id);
        $lecture = $course->lectures()->findOrFail($lecture_id);

        $lecturesCountByCategory = $course->lectures->groupBy('lecture_categories_id')->map(function ($lectures) {
            return $lectures->count();
        });

        return view('client.lecture.lecture', compact('course', 'lecture', 'lecturesCountByCategory'));
    }
    public function convertLink($url): mixed
    { // truyền link vô đề đối thành link xem được 
        if (strpos($url, 'drive.google.com') !== false) {
            preg_match('/\/d\/(.*?)\//', $url, $matches);
            if (!empty($matches[1])) {
                return "https://drive.google.com/file/d/{$matches[1]}/preview";
            }
        }
        return $url;
    }
}
