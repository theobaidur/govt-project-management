<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectClient extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'description',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    public function projects(){
        return $this->hasMany(Project::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/project-clients/'.$this->getKey());
    }
}
