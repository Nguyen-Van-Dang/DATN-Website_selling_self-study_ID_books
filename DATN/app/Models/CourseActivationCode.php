<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseActivationCode extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['course_activation_id', 'activation_code', 'user_id', 'activation_date'];

    public function courseActivation()
    {
        return $this->belongsTo(CourseActivation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
