<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_post_id',
        'apply_date',
        'status',
        'cover_letter',
        'current_salary',
        'expected_salary',
    ];

    public function job()
    {
        return $this->belongsTo(JobPost::class, 'job_post_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
