<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    protected $fillable = [
        'type',
        'quantity',
        'unit_name',
        'unit_price',
        'stock_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    public function stock(){
        return $this->belongsTo(Stock::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/stock-entries/'.$this->getKey());
    }

    public function toString(){
        if($this->stock()){
            return $this->stock->toString();
        } else {
            return 'STO '. $this->id;
        }
    }
}
