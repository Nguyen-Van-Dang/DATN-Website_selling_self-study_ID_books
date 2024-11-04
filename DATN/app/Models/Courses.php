<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Courses extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'discount',
        'amount_lecture',
        'description',
        'image_url',
        'user_id',
        'category_course_id',
        'status'
    ];

    public  function Book(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public  function LectureCategories()
    {
        return $this->belongsToMany(LectureCategories::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public static function getAll()
    {
        return self::all();
    }
    public function documents()
    {
        return $this->hasMany(Documents::class);
    }
}
