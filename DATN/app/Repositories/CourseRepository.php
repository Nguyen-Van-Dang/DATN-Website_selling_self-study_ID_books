<?php

namespace App\Repositories;

use App\Models\ChatGroup;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\PaymentMethods;
use App\Models\User;
use App\Models\Lecture;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\LectureCategories;
use Illuminate\Support\Facades\Auth;

class CourseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    // admin
    public function edit($id)
    {
        $course = Course::with([
            'user',
            'documents',
            'lectures.LectureCategories'
        ])->findOrFail($id);

        $user = $course->user;
        $lectureCategories = LectureCategories::all();
        $subjects = Subject::all();
        $classes = ClassModel::all();
        // Lấy danh sách giáo viên chỉ khi người dùng là admin (ID = 1)
        if (Auth::user()->role_id == 1) {
            $teachers = User::where('role_id', 2)->get();
        } else {
            // Nếu là giáo viên, chỉ lấy thông tin của chính người dùng
            $teachers = User::where('id', Auth::id())->get();
        }
        // Truyền dữ liệu vào component Livewire
        return view('admin.course.updateCourse', compact('course', 'user', 'lectureCategories', 'teachers', 'subjects', 'classes'));
    }
    public function create()
    {
        if (Auth::user()->role_id == 1) {
            // Hiển thị giáo viên chưa kích hoạt
            $teachers = User::where('role_id', 2)->where('active', 0)->get();
        } else {
            // Nếu là giáo viên, không hiển thị danh sách giáo viên, chỉ chọn chính mình
            $teachers = null;
        }
        return view('admin.course.addCourse', compact('teachers'));
    }
    public function getAllCourse()
    {
        $Course = Course::getAll();

        return view('admin.course.listCourse', ['Course' => $Course]);
    }
    //client
    public function getCourseById($id)
    {

        $paymentMethods = PaymentMethods::all();
        $course = Course::with(['lectures.lectureCategory'])->findOrFail($id);

        $userId = $course->user_id;
        $course->increment('views');
        $user = User::with('courses')->findOrFail($userId);
        $lecturesCountByCategory = $course->lectures->groupBy('lecture_categories_id')->map(function ($lectures) {
            return $lectures->count();
        });

        $chatGroup = ChatGroup::where('course_id', $course->id)->first();
        if (!$chatGroup) {
            $chatGroup = '';
        }
        $exams = Exam::where('course_id', $course->id)
            ->with(['results' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->get();
        return view('client.course.courseDetail', compact('course', 'lecturesCountByCategory', 'user', 'paymentMethods', 'chatGroup', 'exams'));
    }
}
