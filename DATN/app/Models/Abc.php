<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abc extends Model
{
    use HasFactory;
    protected $fillable = ['thumbnail', 'url'];
    public static function getAll ()
    {
        return self::all();
    }
}
