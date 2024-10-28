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
        'category_course_id',
    ];

    public  function Book() : HasMany{
        return $this->hasMany(Book::class);
    }

    public  function Lecture() : HasMany{
        return $this->hasMany(Lecture::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public static function getAll(){
        return self::all();
    }
}
