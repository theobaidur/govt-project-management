<?php

namespace App\Models;

use App\BaseModel;

class Document extends BaseModel
{
    protected $has_file = true;
    protected $file_field = 'related_files';
    protected $fillable = [
        'name',
        'description',
        'document_category_id',
        'project_id'
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    public function documentCategory(){
        return $this->belongsTo(DocumentCategory::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/documents/'.$this->getKey());
    }
}
