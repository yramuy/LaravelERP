<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        "emp_number",
        "employee_id",
        "first_name",
        "last_name",
        "email",
        "mobile_number",
        "gender",
        "dob",
        "position",
        "profile_pic",
        "is_active"
    ];
}
