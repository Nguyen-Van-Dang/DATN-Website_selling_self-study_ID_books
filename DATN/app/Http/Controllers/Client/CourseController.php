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
use App\Models\LectureComment;
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

        $lecture = Lecture::with(['comments.replies.user', 'comments.user'])->findOrFail($lecture_id);

        $lecturesCountByCategory = $course->lectures->groupBy('lecture_categories_id')->map(function ($lectures) {
            return $lectures->count();
        });
        
        $currentUserId = auth::id();

        $hasEnrolled = EnrollCourse::where('user_id', $currentUserId)->where('course_id', $course_id)->exists();
        
        LectureHistoryController::updateHistory($lecture_id);
        $hasEnrolled = EnrollCourse::where('user_id', $currentUserId)->where('course_id', $course_id)->exists();
        $user = Auth::user();
        $users = $course->user_id;
        $isFollowing = $user ? $user->followings()->where('following_id', $users)->exists() : false;

        $comments = LectureComment::with('user')
            ->where('lecture_id', $lecture_id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('client.lecture.lecture', compact('course', 'lecture', 'lecturesCountByCategory', 'comments', 'isFollowing'));
    }
    public function store(Request $request)
    {
        $LectureComment = new LectureComment();
        $LectureComment->user_id = Auth::id();
        $LectureComment->lecture_id = $request->lecture_id;
        $LectureComment->parent_id = $request->parent_id;
        $LectureComment->content = $request->content;
        $LectureComment->save();

        return redirect()->back()->with('success', 'Bình luận đã được thêm!');
    }
    public function toggleFollow($userId)
    {
        $followingUser  = User::findOrFail($userId);
        $follower = Auth::user();

        if (!$follower) {
            return response()->json(['success' => false, 'message' => 'Vui lòng đăng nhập!'], 401);
        }

        $follow = $follower->followings()->where('following_id', $followingUser->id)->first();
        if ($follow) {
            $follower->followings()->detach($followingUser->id);
            $is_following = false;
        } else {
            $follower->followings()->attach($followingUser->id);
            $is_following = true;
        }

        $new_follower_count = $followingUser->followers()->count();

        return response()->json([
            'success' => true,
            'is_following' => $is_following,
            'new_follower_count' => $new_follower_count,
        ]);
    }
}
