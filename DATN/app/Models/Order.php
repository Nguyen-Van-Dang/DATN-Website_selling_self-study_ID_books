<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function User()
{
    return $this->belongsTo(User::class);
}
    
    public function Payment(): BelongsTo
    {
        return $this->BelongsTo(Payment::class);
    }

    protected $fillable = [
        'price',
        'payment_status',
        'payment_method',
        'user_id'
    ];

    public static function getAll(){
        return self::all();
    }
}
