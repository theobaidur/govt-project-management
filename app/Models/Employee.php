<?php

namespace App\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Employee extends BaseModel
{
    protected $has_file = true;
    protected $file_field = 'related_files';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'department_id',
        'employee_designation_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function employeeDesignation(){
        return $this->belongsTo(EmployeeDesignation::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/employees/'.$this->getKey());
    }
}
