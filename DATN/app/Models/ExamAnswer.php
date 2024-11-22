<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'is_correct',
        'exam_question_id'
    ];

    // Quan hệ với bảng exam_question
    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'question_id');
    }


    public function userAnswers()
    {
        return $this->hasMany(ExamUserAnswer::class);
    }
}
