<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\PaymentMethods;
use App\Models\User;

class CourseRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllCourse()
    {
        $Course = Course::getAll();

        return view('admin.course.listCourse', ['Course' => $Course]);
    }

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

        return view('client.course.courseDetail', compact('course', 'lecturesCountByCategory', 'user', 'paymentMethods'));
    }
}
