<?php

namespace App\Livewire\Client\Exam;

use App\Models\Course;
use App\Models\Exam;
use App\Models\EnrollCourse;
use App\Models\ExamResult;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ListExam extends Component
{
    public $enrollCourses;
    public $selectedCourseId = 'all';
    public $exams;
    public $examResult;

    public function mount()
    {
        $this->enrollCourses = Course::whereIn('id', EnrollCourse::where('user_id', Auth::id())->pluck('course_id'))
            ->get();

        $this->loadExams();
    }

    public function loadExams()
    {
        if ($this->selectedCourseId === 'all') {
            $this->exams = Exam::all();
        } else {
            $this->exams = Exam::where('course_id', $this->selectedCourseId)->get();
        }
        $this->examResult = ExamResult::where('user_id', auth::id())->get();
    }

    public function updatedSelectedCourseId()
    {
        $this->loadExams();
    }

    public function render()
    {
        return view('livewire.client.exam.list-exam');
    }
}
