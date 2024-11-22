<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\EnrollCourse;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ExamUserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        return view('client.exam.examList');
    }

    public function doExam($examId)
    {
        $examCheck = Exam::where('id', $examId)->first();
        if ($examCheck) {
            $enrollCourses = EnrollCourse::where('course_id', $examCheck->course_id)->where('user_id', Auth::id())->first();
            if ($enrollCourses) {
                return view('client.exam.doExam', compact('examCheck'));
            }
        }
        return redirect()->route(route: 'de-thi.index')->with('error', 'Bạn không sở hữu khoá học này');
    }

    public function showExam($examId)
    {
        $examResult = ExamResult::where('id', $examId)
            ->where('user_id', Auth::id())
            ->with('exam.questions.answers')
            ->first();

        if (!$examResult) {
            return redirect()->route('de-thi.index')->with('error', 'Bạn không sở hữu bài thi này.');
        }

        $userAnswers = ExamUserAnswer::where('result_id', $examResult->id)->pluck('answer_id', 'question_id');

        $questions = $examResult->exam->questions->map(function ($question) use ($userAnswers) {
            $userAnswerId = $userAnswers[$question->id] ?? null;
            $correctAnswer = $question->answers->where('is_correct', true)->first();

            $question->user_answer_id = $userAnswerId;
            $question->correct_answer_id = $correctAnswer->id ?? null;
            $question->is_correct = $userAnswerId == $correctAnswer->id;

            return $question;
        });

        $previousResults = ExamResult::where('exam_id', $examResult->exam_id)
            ->where('user_id', Auth::id())
            ->where('id', '!=', $examId) // Loại bỏ kết quả hiện tại
            ->orderBy('created_at', 'desc')
            ->get();

        return view('client.exam.showExam', compact('examResult', 'questions', 'previousResults'));
    }
}
