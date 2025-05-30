<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTo extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_sup',
        'emp_sub',
        'status'
    ];
}
