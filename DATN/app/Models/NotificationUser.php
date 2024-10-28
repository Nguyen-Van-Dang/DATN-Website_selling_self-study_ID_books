<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notification_id',
        'status',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getAll()
    {
        return self::all();
    }
}
