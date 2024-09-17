<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $table = 'screen';

    public function userRoleScreen()
    {
        return $this->hasMany(UserRoleScreen::class, 'screen_id');
    }

    public function menuItem()
    {
        return $this->hasOne(MenuItem::class, 'screen_id');
    }

    protected $fillable = [
        "screen_name"
    ];
}
