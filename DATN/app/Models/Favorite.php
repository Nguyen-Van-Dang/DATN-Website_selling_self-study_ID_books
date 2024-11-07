<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
    ];
    public  function Book(): BelongsTo
    {
        return $this->BelongsTo(Book::class);
    }

    public  function User(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
