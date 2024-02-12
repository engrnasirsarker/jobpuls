<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'class_id',
        'fees_discount_id',
        'session_id',
        'class_id',
        'group_id',
        'shift_id',
    ];
}
