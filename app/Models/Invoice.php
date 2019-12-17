<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'system_invoice_no',
        'billing_invoice_no',
        'transaction_type',
        'invoice_type',
        'amount',
        'cash',
        'tax',
        'security_money',
        'note',
        'billing_account_id',
        'project_id',
    
    ];
    
    
    protected $dates = [
        'created_at',
        'updated_at',
    
    ];
    
    protected $appends = ['resource_url'];
    
    public function billingAccount(){
        return $this->belongsTo(BillingAccount::class);
    }

    public function invoiceItems(){
        return $this->hasMany(InvoiceItem::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function stockEntries(){
        return $this->hasMany(StockEntry::class);
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/invoices/'.$this->getKey());
    }
}
