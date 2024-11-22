<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'exam_id'
    ];

    // Quan hệ với bảng exam_answers
    public function answers()
    {
        return $this->hasMany(ExamAnswer::class, 'question_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function userAnswers()
    {
        return $this->hasMany(ExamUserAnswer::class);
    }
}
