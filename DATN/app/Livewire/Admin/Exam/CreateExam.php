<?php

namespace App\Livewire\Admin\Exam;

use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExamImport;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;

class CreateExam extends Component
{
    use WithFileUploads;

    public $exam_name, $teachers, $teacherId, $selectedTeacher, $courseId, $selectedCourse, $examFile, $examName, $examDescription;
    public $questions = [];

    public $instructors;
    public $courses;

    public function submit()
    {
        $validatedData = $this->validate([
            'courseId' => 'required|exists:courses,id',
            'examFile' => 'required',
            'examName' => 'required',
            'examDescription' => 'nullable'
        ], [
            'courseId.required' => 'Bạn phải chọn một khóa học.',
            'examFile.required' => 'Vui lòng nhập bộ đề bài tập.',
            'examFile.mimes' => 'Định dạng không hợp lệ (xlsx, xls).',
            'examName.required' => 'Vui lòng nhập tên bài tập.',
        ]);
        $exam = Exam::create([
            'name' => $this->examName,
            'description' => $this->examDescription,
            'course_id' => $this->courseId,
        ]);
        foreach ($this->questions as $questionData) {
            $question = ExamQuestion::create([
                'question' => $questionData[0],
                'exam_id' => $exam->id,
            ]);

            for ($i = 1; $i <= 4; $i++) {
                $examAnswer = new ExamAnswer;
                $examAnswer->answer = $questionData[$i];
                $examAnswer->is_correct = ($questionData[5] == $i);
                $examAnswer->question_id = $question->id;
                $examAnswer->save();
            }
        }
        return redirect()->route('admin.de-thi.index')->with('success', 'Thêm bài tập thành công');
    }
    public function mount()
    {
        if (Auth::user()->role_id == 1) {
            $this->teachers = User::where('role_id', 2)->where('active', 0)->get();
        } else {
            $this->teachers = User::where('id', Auth::id())->first();
            $this->selectedTeacher = User::where('id', Auth::id())->first();
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

    public function render()
    {
        return view('livewire.admin.exam.create-exam');
    }
}
