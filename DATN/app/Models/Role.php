<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'description',
    ];

    public  function Users() : HasMany{
        return $this->hasMany(User::class);
    }

    public static function  getAllRole()
    {
        return self::all();
    }
}
