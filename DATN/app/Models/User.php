<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'name',
        'email',
        'password',
        'phone',
        'loginType',
        'role_id',
        'token',
        'delete_at',
    ];

    public function Role(): BelongsTo
    {
        return $this->BelongsTo(Role::class);
    }
    public function Order(): BelongsTo
    {
        return $this->BelongsTo(Order::class);
    }

    public function reels()
    {
        return $this->hasMany(Reels::class);
    }
    public function reelComments()
    {
        return $this->hasMany(ReelComment::class);
    }


    public  function Book() : HasMany{
        return $this->hasMany(Book::class);
    }

    public  function Course() : HasMany{
        return $this->hasMany(Course::class);
    }

    public  function Lecture() : HasMany{
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

    public function Notification(): BelongsTo
    {
        return $this->BelongsTo(Notification::class);
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public static function getAll(){
        return self::all();
    }
}
