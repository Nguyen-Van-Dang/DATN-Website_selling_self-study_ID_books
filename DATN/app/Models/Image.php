<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'image_url',
        'image_name',
    ];
    public function imageable()
    {
        return $this->morphTo();
    }
}
