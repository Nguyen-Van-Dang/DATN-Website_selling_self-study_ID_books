<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseActivation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['book_id', 'course_id'];

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
    public function codes()
    {
        return $this->hasMany(CourseActivationCode::class)->withTrashed();
    }
}
