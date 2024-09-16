<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    protected $table = 'screen';

    public function rolePermissions()
    {
        return $this->hasMany(RolePermissions::class, 'screen_id');
    }

    public function menuItem()
    {
        return $this->hasOne(MenuItems::class, 'screen_id');
    }

    protected $fillable = [
        "screen_name"
    ];
}
