<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demerit extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'points',
        'description',
        'date',
        'time',
        'previous_points'
    ];
}
