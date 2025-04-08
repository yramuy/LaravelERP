<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type',
        'length_hours',
        'length_days',
        'from_date',
        'to_date',
        'emp_number',
        'duration_type',
        'session_type',
        'comment',
        'leave_status',
    ];
}
