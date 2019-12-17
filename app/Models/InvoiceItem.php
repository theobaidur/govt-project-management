<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'type',
        'description',
        'quantity',
        'unit_name',
        'unit_price',
        'amount',
        'invoice_id',
        'stock_id',
        'sl_no'
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/invoice-items/'.$this->getKey());
    }
}
