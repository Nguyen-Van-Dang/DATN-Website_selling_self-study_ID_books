<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_url',
        'created_by',
        'course_id',
    ];
    public function course()
    {
        return $this->hasMany(Course::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
