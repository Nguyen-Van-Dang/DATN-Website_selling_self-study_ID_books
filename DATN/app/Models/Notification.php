<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public static function getAll()
    {
        return self::all();
    }
    // public static function getAll1()
    // {
    //     return self::all();
    // }0

    public static function getNotificationById($id)
    {
        return self::find($id);
    }

    public static function deleteById($id)
    {
        return self::destroy($id);
    }
}
