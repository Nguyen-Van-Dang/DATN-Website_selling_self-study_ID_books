<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LectureComment extends Model
{
    protected $fillable = ['user_id', 'lecture_id', 'parent_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
