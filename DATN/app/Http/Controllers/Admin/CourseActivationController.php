<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Course;
use App\Models\CourseActivationCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourseActivationExport;
use App\Models\CourseActivation;

class CourseActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.courseActivation.listCourseActivation');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role_id == 1) {
            $teachers = User::where('role_id', 2)->where('active', 0)->get();
            $courses = Course::where('status', 0)->get();
            $books = Book::where('status', 0)->get();
        } else {
            $courses = Course::where('status', 0)->where('user_id', Auth::user()->id)->get();
            $books = Book::where('status', 0)->where('user_id', Auth::user()->id)->get();
        }
        return view('admin.courseActivation.createCourseActivation', compact('teachers', 'courses', 'books'));
    }

    public function export($courseActivationId)
    {
        if (Auth::user()->role_id == 1) {
            return Excel::download(new CourseActivationExport($courseActivationId), 'course_activation_codes.xlsx');
        } else {
            return redirect()->back()->withErrors(['Không có quyền truy cập.']);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (Auth::user()->role_id !== 1) {
            return redirect()->back()->withErrors(['Không có quyền truy cập.']);
        }
        $courseActivation = CourseActivation::where('id', $id)->first();
        $codes = CourseActivationCode::where('course_activation_id', $id)->whereNotNull('user_id')->get();
        return view('admin.courseActivation.editCourseActivation', compact('courseActivation', 'codes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $courseActivation = CourseActivation::where('id', $id)->first();
        if (!$courseActivation) {
            return redirect()->back()->with('error', 'Không tìm thấy');
        };
        if ($request->status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $courseActivation->status = $status;
        $courseActivation->save();

        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role_id != 1) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa');
        }

        $courseActivation = CourseActivation::find($id);

        if (!$courseActivation) {
            return redirect()->back()->with('error', 'Mã kích hoạt không tồn tại');
        }

        if ($courseActivation->status != 1) {
            return redirect()->back()->with('error', 'Mã kích hoạt đang hoạt động');
        }

        $usedActivationCodes = CourseActivationCode::where('course_activation_id', $courseActivation->id)
            ->whereNotNull('user_id')
            ->exists();

        if ($usedActivationCodes) {
            return redirect()->back()->with('error', 'Mã kích hoạt đã được sử dụng');
        }

        $courseActivation->delete();

        return redirect()->back()->with('success', 'Mã kích hoạt đã được xóa thành công');
    }
}
