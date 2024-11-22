<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_id',
        'result_id',
        'question_id'
    ];

    public function answer()
    {
        return $this->belongsTo(ExamAnswer::class, 'answer_id');
    }

    public function result()
    {
        return $this->belongsTo(ExamResult::class, 'result_id');
    }

    public function question()
    {
        return $this->belongsTo(ExamQuestion::class, 'question_id');
    }
}
