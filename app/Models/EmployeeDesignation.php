<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDesignation extends Model
{
    protected $fillable = [
        'name',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    public function employees(){
        return $this->hasMany(Employee::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/employee-designations/'.$this->getKey());
    }
}
