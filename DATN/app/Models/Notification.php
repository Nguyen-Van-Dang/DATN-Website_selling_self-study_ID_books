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

    public static function getAll()
    {
        return self::all();
    }

    public static function getNotificationById($id)
    {
        return self::findOrFail($id);
    }


    public static function deleteById($id)
    {
        return self::destroy($id);
    }
}
