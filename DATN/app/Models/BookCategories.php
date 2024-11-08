<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'user_id',
        'description',
        'deleted_at',
    ];

    public  function Book(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getAll()
    {
        return self::all();
    }
}
