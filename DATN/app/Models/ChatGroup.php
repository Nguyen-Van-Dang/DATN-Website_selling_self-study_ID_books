<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatGroup extends Model
{

    protected $fillable = ['name', 'description', 'course_id'];

    use SoftDeletes;

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
        return $this->hasOne(Course::class, 'id');
    }

    // public function latestMessage()
    // {
    //     return $this->hasOne(ChatMessage::class)
    //         ->select('id', 'group_id', 'message', 'created_at')
    //         ->orderBy('created_at', 'desc');
    // }
}
