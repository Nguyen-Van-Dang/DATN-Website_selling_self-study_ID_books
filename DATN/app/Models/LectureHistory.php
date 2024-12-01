<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LectureHistory extends Model
{
    protected $fillable = ['user_id', 'lecture_id', 'last_accessed_at'];
    
    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

