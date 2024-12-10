<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;
use App\Models\EnrollCourse;
use App\Http\Controllers\Client\LectureHistoryController;
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

        $currentUserId = auth::id();

        $hasEnrolled = EnrollCourse::where('user_id', $currentUserId)->where('course_id', $course_id)->exists();
        
        LectureHistoryController::updateHistory($lecture_id);

        return view('client.lecture.lecture', compact('course', 'lecture', 'lecturesCountByCategory'));
    }
}
