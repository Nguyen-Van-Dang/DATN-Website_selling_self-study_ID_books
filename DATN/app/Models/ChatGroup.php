<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatGroup extends Model
{

    protected $fillable = ['name', 'description', 'course_id', 'avatar'];

    use SoftDeletes, HasFactory;

    public function participants()
    {
        return $this->hasMany(ChatParticipant::class, 'group_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class, 'group_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
