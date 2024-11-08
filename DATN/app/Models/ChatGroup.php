<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatGroup extends Model implements HasMedia
{

    protected $fillable = ['name', 'description', 'course_id', 'avatar'];

    use SoftDeletes, HasFactory, InteractsWithMedia;


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')->useDisk('google');
    }
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
}
