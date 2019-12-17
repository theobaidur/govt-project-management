<?php

namespace App\Models;

use App\BaseModel;

class Stock extends BaseModel
{
    protected $has_file = true;
    protected $file_field = 'related_files';

    protected $fillable = [
        'name',
        'description',
        'project_id'
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    public function stockEntries(){
        return $this->hasMany(StockEntry::class);
    }

    public function balance(){
        $in = $this->stockEntries->where('type', 'load')->sum('quantity');
        $out = $this->stockEntries->where('type', 'unload')->sum('quantity');
        return (object)[
            'total_load'=> $in,
            'total_unload'=> $out,
            'balance'=> $in - $out
        ];
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/stocks/'.$this->getKey());
    }
}
