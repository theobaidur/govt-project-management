<?php

namespace App\Models;

use App\BaseModel;
use Brackets\AdminAuth\Models\AdminUser;

class Project extends BaseModel
{
    protected $has_file = true;
    protected $file_field = 'related_files';
    
    protected $fillable = [
        'name',
        'description',
        'amount',
        'bank_guarantee_amount',
        'start_date',
        'end_date',
        'department_id',
        'project_client_id',
        'project_director_id',
    
    ];
    
    
    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function projectClient(){
        return $this->belongsTo(ProjectClient::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
    
    public function stocks(){
        return $this->hasMany(Stock::class);
    }

    public function investors(){
        return $this->hasMany(Investor::class);
    }

    public function projectDirector(){
        return $this->belongsTo(AdminUser::class, 'project_director_id');
    }

    public function stat(){
        return (object)[
            'amount'=> $this->amount,
            'total_debit'=> 0,
            'total_credit'=> 0
        ];
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/projects/'.$this->getKey());
    }
}
