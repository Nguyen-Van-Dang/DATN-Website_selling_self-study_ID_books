<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'user_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Course()
    {
        return $this->belongsTo(Course::class);
    }
}
