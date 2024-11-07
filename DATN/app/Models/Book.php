<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'page_number',
        'course_id',
        'description',
        'quantity',
        'book_activate_id',
        'activated_at',
        'activated_by',
        'book_active',
        'category_books_id',
        'image',
        'is_favorite',
    ];

    public function Course(): BelongsTo
    {
        return $this->BelongsTo(Course::class);
    }

    public function User(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function CategoryBook(): BelongsTo
    {
        return $this->belongsTo(CategoryBook::class, 'category_books_id'); // Đảm bảo trường khóa ngoại đúng
    }

    public function Favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function cartDetails(): HasMany
    {
        return $this->hasMany(CartDetail::class);
    }
    
    public static function getAll()
    {
        return self::all();
    }
}
