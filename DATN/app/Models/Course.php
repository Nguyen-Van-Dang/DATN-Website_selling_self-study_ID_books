<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'amount_lecture',
        'description',
        'image_url',
        'user_id',
    ];

    public  function Book(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    public  function Lecture(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Định nghĩa mối quan hệ đến User
    }
    public function courseActivations()
    {
        return $this->hasMany(CourseActivation::class);
    }
    public static function getAll()
    {
        return self::all();
    }
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
