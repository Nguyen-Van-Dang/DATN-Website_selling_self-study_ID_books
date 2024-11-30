<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lecture_id',
        'last_accessed_at',
    ];
    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lecture_id');
    }
}
