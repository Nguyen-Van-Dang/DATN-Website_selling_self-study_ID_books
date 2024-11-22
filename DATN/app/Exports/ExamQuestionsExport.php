<?php

namespace App\Exports;

use App\Models\ExamQuestion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamQuestionsExport implements FromCollection, WithHeadings
{
    protected $examId;

    public function __construct($examId)
    {
        $this->examId = $examId;
    }

    /**
     * Lấy dữ liệu cho file Excel
     */
    public function collection()
    {
        return ExamQuestion::where('exam_id', $this->examId)
            ->with('answers')
            ->get()
            ->map(function ($question) {
                $answers = $question->answers->pluck('answer')->toArray();
                $correctAnswerIndex = $question->answers->search(function ($answer) {
                    return $answer->is_correct == 1;
                }); // Lấy chỉ số đáp án đúng

                return [
                    'question'   => $question->question,
                    'answer_1'   => $answers[0] ?? '',
                    'answer_2'   => $answers[1] ?? '',
                    'answer_3'   => $answers[2] ?? '',
                    'answer_4'   => $answers[3] ?? '',
                    'is_correct' => $correctAnswerIndex !== false ? $correctAnswerIndex + 1 : '',
                ];
            });
    }

    /**
     * Định nghĩa header cho file Excel
     */
    public function headings(): array
    {
        return [
            'question',
            'answer_1',
            'answer_2',
            'answer_3',
            'answer_4',
            'correct_answer',
        ];
    }
}
