<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ReelComment;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'zalo_id',
        'name',
        'image_url',
        'phone',
        'email',
        'password',
        'loginType',
        'token',
        'role_id',
        'delete_at',
        'created_at',
        'updated_at',

    ];

    public function Role(): BelongsTo
    {
        return $this->BelongsTo(Role::class);
    }
    public function Order(): BelongsTo
    {
        return $this->BelongsTo(Order::class);
    }
    public function reelComments()
    {
        return $this->hasMany(ReelComment::class);
    }
    public  function Books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
    public function Reels()
    {
        return $this->hasMany(Reels::class);
    }
    public function Courses()
    {
        return $this->hasMany(Course::class, 'user_id');
    }
    public  function Lecture(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }
    public function CategoryCourse(): HasMany
    {
        return $this->hasMany(CourseCategories::class);
    }
    public function CategoryBook(): HasMany
    {
        return $this->hasMany(CategoryBook::class);
    }
    public function Favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
    public function cartDetails()
    {
        return $this->hasMany(CartDetail::class);
    }
    public function NotificationUser(): BelongsTo
    {
        return $this->BelongsTo(NotificationUser::class);
    }
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getAll()
    {
        return self::all();
    }
}
