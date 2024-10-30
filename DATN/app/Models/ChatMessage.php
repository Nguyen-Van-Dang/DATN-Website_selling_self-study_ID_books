<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['user_id', 'group_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chatGroup()
    {
        return $this->belongsTo(ChatGroup::class, 'group_id');
    }
}
