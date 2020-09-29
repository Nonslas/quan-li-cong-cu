<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Menu extends Model
{
    use HasFactory;

    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }

    public function submenus()
    {
    	return $this->hasMany(Submenu::class);
    }

}
