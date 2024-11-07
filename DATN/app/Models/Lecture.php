<?php

namespace App\Models;

use Database\Factories\CoursesFactory;
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
    public function Course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function LectureCategories()
    {
        return $this->belongsTo(LectureCategories::class, 'lecture_categories_id');
    }

    public function lectureCategory() // Tên phương thức này đã được thay đổi thành số ít để nhất quán
    {
        return $this->belongsTo(LectureCategories::class, 'lecture_categories_id');
    }
}
