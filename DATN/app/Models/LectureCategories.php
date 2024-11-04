<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Lecture;
class LectureCategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'created_by',
    ];
    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class, 'lecture_categories_id'); // Đảm bảo tên cột đúng
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class);
    }
}
