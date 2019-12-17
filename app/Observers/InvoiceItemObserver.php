<?php

namespace App\Observers;

use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Log;

class InvoiceItemObserver
{
    /**
     * Handle the invoice item "created" event.
     *
     * @param  \App\InvoiceItem  $invoiceItem
     * @return void
     */
    public function created(InvoiceItem $invoiceItem)
    {
        //
    }

    /**
     * Handle the invoice item "updated" event.
     *
     * @param  \App\InvoiceItem  $invoiceItem
     * @return void
     */
    public function updated(InvoiceItem $invoiceItem)
    {
        Log::debug($invoiceItem);
        $item = $invoiceItem->stockEntry()->get();
        if(!empty($item)){
            $item->quantity = $invoiceItem->quantity;
            $item->unit_name = $invoiceItem->unit_name;
            $item->unit_price = $invoiceItem->unit_price;
            $item->save();
        }
    }

    /**
     * Handle the invoice item "deleted" event.
     *
     * @param  \App\InvoiceItem  $invoiceItem
     * @return void
     */
    public function deleting(InvoiceItem $invoiceItem)
    {
        $item = $invoiceItem->stockEntry()->get();
        if(!empty($item)){
            $item->delete();
        }
    }

    /**
     * Handle the invoice item "restored" event.
     *
     * @param  \App\InvoiceItem  $invoiceItem
     * @return void
     */
    public function restored(InvoiceItem $invoiceItem)
    {
        //
    }

    /**
     * Handle the invoice item "force deleted" event.
     *
     * @param  \App\InvoiceItem  $invoiceItem
     * @return void
     */
    public function forceDeleted(InvoiceItem $invoiceItem)
    {
        //
    }
}
