<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'price',
        'payment_status',
        'user_name',
        'user_phone',
        'address',
        'payment_method',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            do {
                $randomId = str_pad(mt_rand(0, 99999), 4, '0', STR_PAD_LEFT);
            } while (Order::where('id', $randomId)->exists());

            $order->id = $randomId;
        });
    }

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
