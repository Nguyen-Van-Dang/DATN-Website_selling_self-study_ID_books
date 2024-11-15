<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseActivation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['book_id', 'course_id', 'user_id', 'activation_code', 'activation_date'];

    // Quan hệ ngược với Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Quan hệ ngược với Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Nếu có trường hợp mỗi CourseActivation thuộc về một User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
