<?php

namespace App\Http\Controllers\Client;

use App\Models\CourseActivation;
use App\Models\Book;
use App\Models\Course;
use App\Models\EnrollCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CourseActivationCode;

class CourseActivationController extends Controller
{
    //
    public function index()
    {
        return view('client.book.bookID');
    }

    public function checkBook($book_id)
    {
        $book = Book::find($book_id);
        if (!$book) {
            return redirect()->route('kich-hoat-sach')->withErrors(['Sách với ID ' . $book_id . ' không tồn tại.']);
        }

        $courseActivation = CourseActivation::where('book_id', $book_id)->where('status', 0)->first();
        if (!$courseActivation) {
            return redirect()->route('kich-hoat-sach')->withErrors(['Sách không có khoá học đi kèm.']);
        }

        return view('client.book.book_id_active', compact('book'));
    }
    public function redirect(Request $request)
    {
        $request->validate([
            'book_id' => 'required|numeric|digits:4',
        ], [
            'book_id.required' => 'Vui lòng nhập ID sách.',
            'book_id.numeric' => 'ID sách phải gồm 4 chữ số.',
            'book_id.digits' => 'ID sách phải gồm 4 chữ số.',
        ]);

        $book_id = $request->input('book_id');
        return redirect()->route('kich-hoat-sach.checkBook', ['book_id' => $book_id]);
    }

    public function activate(Request $request)
    {
        $request->validate([
            'activation_code' => 'required|size:25',
            'book_id' => 'required|integer'

        ], [
            'activation_code.required' => 'Vui lòng nhập mã kích hoạt.',
            'activation_code.size' => 'Mã kích hoạt phải gồm 16 ký tự',
        ]);

        $activationCode = $request->input('activation_code');
        $bookId = $request->input('book_id');
        $activationCode = str_replace(' - ', '', $activationCode);

        $courseActivation = CourseActivation::where('book_id', $bookId)->first();

        $codeAvailable = CourseActivationCode::where('activation_code', $activationCode)
            ->where('course_activation_id', $courseActivation->id)
            ->whereNull('user_id')
            ->first();
        if (!$codeAvailable) {
            return redirect()->back()->with('error', 'Mã kích hoạt không hợp lệ hoặc đã được sử dụng.');
        }

        $courseCheck = Course::where('status', 1)
            ->where('id', $courseActivation->course_id)
            ->first();
        if ($courseCheck) {
            return redirect()->back()->with('error', 'Khoá học không hoạt động');
        }

        $enrollCheck = EnrollCourse::where('user_id', auth::id())
            ->where('course_id', $courseActivation->course_id)
            ->first();
        if ($enrollCheck) {
            return redirect()->back()->with('error', 'Bạn đã sở hữu khóa học này, không thể kích hoạt thêm.');
        }

        $codeAvailable->user_id = auth::id();
        $codeAvailable->activation_date = now();
        $codeAvailable->save();

        EnrollCourse::create([
            'user_id' => auth::id(),
            'course_id' => $courseActivation->course_id,
            'enroll_date' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Kích hoạt thành công');
    }
}
