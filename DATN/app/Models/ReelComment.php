<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReelComment extends Model
{
    use HasFactory;

    protected  $fillable = [
        'reel_id',
        'user_id',
        'content',
        'parent_id ',
        'is_show',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reel()
    {
        return $this->belongsTo(Reels::class);
    }
    public static function getAll()
    {
        return self::all();
    }
}
