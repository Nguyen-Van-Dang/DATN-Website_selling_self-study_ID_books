<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReelComment;

class Reels extends Model
{
    use HasFactory;
    protected  $fillable = [
        'user_id',
        'title',
        'video_url',
        'image_url',
        'comments_count',
        'likes_count',
        'views_count',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reelComments()
    {
        return $this->hasMany(ReelComment::class);
    }

    public static function getAll()
    {
        return self::all();
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function likes()
    {
        return $this->hasMany(ReelLike::class);
    }
}
