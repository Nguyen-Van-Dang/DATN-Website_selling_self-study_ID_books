<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BookCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'deleted_at',
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class, 'book_categories_mapping', 'category_id', 'book_id');
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
