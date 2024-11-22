<?php

namespace App\Livewire\Admin\CourseActivation;

use Livewire\Component;
use App\Models\Book;
use App\Models\Course;
use App\Models\CourseActivation;
use App\Models\CourseActivationCode;
use App\Models\User;
use Illuminate\Support\Str;

class CreateCourseActivation extends Component
{
    public $teachers, $teacherId, $bookId, $courseId, $selectedTeacher, $selectedBook, $selectedCourse, $codeQuantity;
    public $books = [];
    public $courses = [];

    public function mount($teachers)
    {
        $this->teachers = $teachers;
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'teacherId' => 'required|exists:users,id',
            'bookId' => 'required|exists:books,id',
            'courseId' => 'required|exists:courses,id',
        ], [
            'teacherId.required' => 'Bạn phải chọn một giảng viên.',
            'bookId.required' => 'Bạn phải chọn một cuốn sách.',
            'courseId.required' => 'Bạn phải chọn một khóa học.',
        ]);

        $createCourseActivation = new CourseActivation;
        $createCourseActivation->book_id = $this->bookId;
        $createCourseActivation->course_id = $this->courseId;
        $createCourseActivation->status = 0;
        $createCourseActivation->save();

        if ($createCourseActivation) {
            $codeNumber = $this->selectedBook->quantity;
            for ($i = 0; $i < $codeNumber; $i++) {
                $createCodeActivation = new CourseActivationCode;
                $createCodeActivation->course_activation_id = $createCourseActivation->id;
                $createCodeActivation->activation_code =  strtoupper(Str::random(16));
                $createCodeActivation->save();
            }
        }
        return redirect()->route('admin.kich-hoat-sach.index')->with('success', 'Tạo mã kích hoạt thành công');
    }
    public function updatedTeacherId($teacherId)
    {
        $this->loadTeacherContent($teacherId);
        $this->bookId = null;
        $this->selectedBook = null;
        $this->courseId = null;
        $this->selectedCourse = null;
    }

    public function updatedBookId($bookId)
    {
        $this->loadBookContent($bookId);
    }
    public function updatedCourseId($courseId)
    {
        $this->loadCourseContent($courseId);
    }
    public function loadTeacherContent($teacherId)
    {
        $teacher = User::where('id', $teacherId)->first();
        if ($teacher) {
            $this->selectedTeacher = $teacher;
            $this->courses = Course::where('user_id', $teacherId)
                ->whereDoesntHave('courseActivations')->where('status', 0)
                ->get();
            $this->books = Book::where('user_id', $teacherId)
                ->whereDoesntHave('courseActivations')->where('status', 0)->where('quantity', '>', 0)
                ->get();
        }
    }

    public function loadBookContent($bookId)
    {
        $book = Book::where('id', $bookId)->first();
        if ($book) {
            $this->selectedBook = $book;
        }
    }
    public function loadCourseContent($courseId)
    {
        $course = Course::where('id', $courseId)->first();
        if ($course) {
            $this->selectedCourse = $course;
        }
    }

    public function render()
    {
        return view('livewire.admin.course-activation.create-course-activation');
    }
}
