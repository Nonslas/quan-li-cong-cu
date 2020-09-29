<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['equipment_id', 'department_id', 'amount'];

    public function equipment()
    {
    	return $this->hasOne(Equipment::class, 'id', 'equipment_id');
    }
}
