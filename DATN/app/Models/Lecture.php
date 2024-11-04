<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'video_url',
        'course_id',
        'lecture_categories_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function lectureCategory(): BelongsTo
    {
        return $this->belongsTo(LectureCategories::class, 'lecture_categories_id');
    }
    
}
