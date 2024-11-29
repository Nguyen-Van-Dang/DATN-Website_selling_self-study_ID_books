<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image_url',
        'user_id',
        'discount'
    ];

    public  function Book(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Định nghĩa mối quan hệ đến User
    }
    public function documents()
    {
        return $this->hasMany(Documents::class, 'course_id');
    }
    public function courseActivations()
    {
        return $this->hasMany(CourseActivation::class);
    }
    public static function getAll()
    {
        return self::all();
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    
}
