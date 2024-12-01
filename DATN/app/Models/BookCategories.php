<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookCategories extends Model
{
    use HasFactory, SoftDeletes;

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
