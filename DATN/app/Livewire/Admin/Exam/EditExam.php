<?php

namespace App\Livewire\Admin\Exam;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Course;
use App\Models\User;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExamImport;

class EditExam extends Component
{
    use WithFileUploads;

    public $examId, $examName, $examDescription, $courseId;
    public $questions = [];
    public $teachers, $teacherId, $selectedTeacher, $selectedCourse, $courses, $exam;
    public $examFile;

    public function mount($examId)
    {
        $this->examId = $examId;

        $this->exam = Exam::with(['questions.answers', 'course'])->findOrFail($examId);
        $this->examName = $this->exam->name;
        $this->examDescription = $this->exam->description;
        $this->courseId = $this->exam->course_id;

        if (Auth::user()->role_id == 1) {
            $this->teachers = User::where('role_id', 2)->where('active', 0)->get();
            $this->courses = Course::where('status', 0)->get();

            $this->selectedTeacher = $this->exam->course->user;
            $this->selectedCourse = $this->exam->course;
            $this->teacherId = $this->selectedTeacher->id;
        } else {
            $this->selectedCourse = $this->exam->course;
            $this->teachers = User::where('id', Auth::id())->get();
            $this->selectedTeacher = Auth::user();
            $this->teacherId = $this->selectedTeacher->id;
            $this->courses = Course::where('user_id', Auth::id())->where('status', 0)->get();
        }
    }

    public function updatedTeacherId($teacherId)
    {
        $this->loadTeacherContent($teacherId);
        $this->courseId = null;
        $this->selectedCourse = null;
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
                ->where('status', 0)
                ->get();
        }
    }

    public function loadCourseContent($courseId)
    {
        $course = Course::where('id', $courseId)->where('status', 0)->first();
        if ($course) {
            $this->selectedCourse = $course;
        }
    }

    public function updatedExamFile()
    {
        try {

            $path = $this->examFile->getRealPath();

            $data = Excel::toArray(new ExamImport, $path);

            if (empty($data) || empty($data[0])) {
                throw new \Exception('File Excel không chứa dữ liệu.');
            }

            $headers = array_map('strtolower', array_map('trim', $data[0][0]));
            $requiredHeaders = ['question', 'answer_1', 'answer_2', 'answer_3', 'answer_4', 'correct_answer'];

            if (array_diff($requiredHeaders, $headers)) {
                throw new \Exception('File Excel không đúng định dạng yêu cầu. Header phải là: ' . implode(', ', $requiredHeaders));
            }

            $rows = array_slice($data[0], 1);

            foreach ($rows as $index => $row) {
                if (count($row) < 6) {
                    throw new \Exception("Dòng " . ($index + 2) . " thiếu dữ liệu.");
                }

                for ($i = 1; $i <= 4; $i++) {
                    if (empty(trim($row[$i]))) {
                        throw new \Exception("Dòng " . ($index + 2) . ": Cột 'answer_$i' không được để trống.");
                    }
                }

                $correctAnswer = $row[5];
                if (!in_array($correctAnswer, [1, 2, 3, 4])) {
                    throw new \Exception("Dòng " . ($index + 2) . ": Giá trị ở cột 'correct_answer' phải là số từ 1 đến 4.");
                }
            }

            $this->questions = $rows;
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            $this->questions = [];
        }
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'examName' => 'required',
            'courseId' => 'required|exists:courses,id',
        ]);

        $exam = Exam::findOrFail($this->examId);
        $exam->update([
            'name' => $this->examName,
            'description' => $this->examDescription,
            'course_id' => $this->courseId,
        ]);

        // Save questions and answers
        foreach ($this->questions as $questionData) {
            $question = ExamQuestion::updateOrCreate(
                ['id' => $questionData['id'] ?? null, 'exam_id' => $this->examId],
                ['question' => $questionData['question']]
            );

            foreach ($questionData['answers'] as $index => $answerData) {
                ExamAnswer::updateOrCreate(
                    ['id' => $answerData['id'] ?? null, 'question_id' => $question->id],
                    ['answer' => $answerData['text'], 'is_correct' => $answerData['is_correct']]
                );
            }
        }

        return redirect()->route('admin.de-thi.index')->with('success', 'Đã cập nhật bài tập thành công.');
    }

    public function render()
    {
        return view('livewire.admin.exam.edit-exam');
    }
}
