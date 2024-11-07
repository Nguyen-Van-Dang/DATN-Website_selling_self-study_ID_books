<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'payment_status',
        'user_name',
        'user_phone',
        'address',
        'payment_method',
        'user_id',
    ];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function PaymentMethods(): BelongsTo
    {
        return $this->BelongsTo(PaymentMethods::class);
    }


    public static function getAll()
    {
        return self::all();
    }
}
