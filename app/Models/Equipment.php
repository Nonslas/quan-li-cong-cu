<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'detail', 'supplier_id', 'department_id', 'employee_id', 'buy_at', 'assign_at', 'status', 'guarantee', 'type', 'price', 'amount'];

    public function department()
    {
    	return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function employee()
    {
    	return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function supplier()
    {
    	return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }

    public function types()
    {
    	return $this->hasOne(EquipmentType::class, 'id', 'type');
    }
}
