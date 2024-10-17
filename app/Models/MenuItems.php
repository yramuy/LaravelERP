<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    use HasFactory;

    protected $fillable = [
        "menu_title",
        "screen_id",
        "url",
        "is_active",
        "level",
        "parent_id"
    ];
}
