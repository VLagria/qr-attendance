<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'is_present',
        'student_id',
        'date',
        'time',
        'is_absent',
        'is_late',
        'demerit',
        'demerit_remarks',
        'merit',
        'merit_remarks'
    ];
}
