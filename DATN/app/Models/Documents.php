<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;

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
        return $this->hasMany(Courses::class);
    }
}
