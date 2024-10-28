<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public  function Course() : HasMany{
        return $this->hasMany(Course::class);
    }
    public static function getAll(){
        return self::all();
    }
}
