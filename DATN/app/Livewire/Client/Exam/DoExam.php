<?php

namespace App\Livewire\Client\Exam;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamResult;
use App\Models\ExamUserAnswer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DoExam extends Component
{
    public $exam, $canSubmit = false, $totalAnswer, $answeredCount = 0, $unansweredCount = 0, $questions = [], $answers = [];

    public function mount($examCheck)
    {
        $this->exam = $examCheck;
        $this->totalAnswer = $examCheck->questions->count();
        $this->questions = ExamQuestion::where('exam_id', $this->exam->id)
            ->with('answers')
            ->get()
            ->toArray();

        $this->calculateCounts();
    }

    public function updatedAnswers()
    {
        $this->calculateCounts();
        $this->canSubmit = $this->answeredCount === $this->totalAnswer;
    }

    public function calculateCounts()
    {
        $answeredCount = 0;
        $unansweredCount = 0;

        foreach ($this->answers as $answer) {
            if ($answer) {
                $answeredCount++;
            } else {
                $unansweredCount++;
            }
        }

        $this->answeredCount = $answeredCount;
        $this->unansweredCount = $unansweredCount;
    }
    public function calculateProgress()
    {
        if ($this->totalAnswer > 0) {
            return ($this->answeredCount / $this->totalAnswer) * 100;
        }
        return 0;
    }

    public function scrollToQuestion($questionId)
    {
        $this->dispatch('scroll-to-question', ['questionId' => $questionId]);
    }

    public function submitExam()
    {
        $submittedAnswers = [];
        $correctCount = 0;
        $incorrectCount = 0;


        foreach ($this->questions as $index => $question) {
            $userAnswer = $this->answers[$index] ?? null;

            $correctAnswer = collect($question['answers'])->firstWhere('is_correct', true);
            if ($correctAnswer && $userAnswer == $correctAnswer['id']) {
                $correctCount++;
            } else {
                $incorrectCount++;
            }

            $submittedAnswers[] = [
                'question_id' => $question['id'],
                'answer_id' => $userAnswer,
            ];
        }

        $score = round(($correctCount / $this->totalAnswer) * 10, 2);

        $result = new ExamResult;
        $result->exam_id = $this->exam->id;
        $result->user_id = Auth::id();
        $result->score = $score;
        $result->correct_amount = $correctCount;
        $result->incorrect_amount = $incorrectCount;
        $result->save();

        foreach ($submittedAnswers as $answer) {
            $examUserAnswer = new ExamUserAnswer;
            $examUserAnswer->result_id = $result->id;
            $examUserAnswer->question_id = $answer['question_id'];
            $examUserAnswer->answer_id = $answer['answer_id'];
            $examUserAnswer->save();
        }
        return redirect()->route('de-thi.index')->with('success', 'Nộp bài thành công');
    }

    public function render()
    {
        return view('livewire.client.exam.do-exam');
    }
}
