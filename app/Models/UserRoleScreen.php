<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleScreen extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_role_id",
        "screen_id",
        "can_read",
        "can_create",
        "can_update",
        "can_delete"
    ];
}
