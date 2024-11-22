<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;

class ExamImport implements ToModel
{
    public function model(array $row)
    {
        return [
            'question' => $row[0], // Câu hỏi
            'answer_1' => $row[1], // Đáp án 1
            'answer_2' => $row[2], // Đáp án 2
            'answer_3' => $row[3], // Đáp án 3
            'answer_4' => $row[4], // Đáp án 4
            'correct_answer' => $row[5], // Đáp án đúng (1, 2, 3, hoặc 4)
        ];
    }
}
