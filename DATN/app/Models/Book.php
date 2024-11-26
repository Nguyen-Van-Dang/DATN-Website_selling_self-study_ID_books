<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
class Book extends Model
{
    use HasFactory, SoftDeletes;

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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            do {
                $randomId = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            } while (Book::where('id', $randomId)->exists());

            $book->id = $randomId;
        });
    }
    public function Course(): BelongsTo
    {
        return $this->BelongsTo(Course::class);
    }

    public function User(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BookCategories::class, 'book_categories_mapping', 'book_id', 'category_id');
    }

    public function Favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function cartDetails(): HasMany
    {
        return $this->hasMany(CartDetail::class);
    }
    // Quan hệ với CourseActivation
    public function courseActivations()
    {
        return $this->hasMany(CourseActivation::class);
    }
    // Quan hệ thông qua CourseActivation để lấy các khóa học liên quan
    public static function getAll()
    {
        return self::all();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
