<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "menu_title",
        "screen_id",
        "parent_id",
        "level",
        "url",
        "status"
    ];
}
