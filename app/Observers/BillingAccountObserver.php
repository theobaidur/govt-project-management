<?php

namespace App\Observers;

use App\BillingAccount;

class BillingAccountObserver
{
    /**
     * Handle the billing account "created" event.
     *
     * @param  \App\BillingAccount  $billingAccount
     * @return void
     */
    public function created(BillingAccount $billingAccount)
    {
        //
    }

    /**
     * Handle the billing account "updated" event.
     *
     * @param  \App\BillingAccount  $billingAccount
     * @return void
     */
    public function updated(BillingAccount $billingAccount)
    {
        //
    }

    /**
     * Handle the billing account "deleted" event.
     *
     * @param  \App\BillingAccount  $billingAccount
     * @return void
     */
    public function deleted(BillingAccount $billingAccount)
    {
        //
    }

    /**
     * Handle the billing account "restored" event.
     *
     * @param  \App\BillingAccount  $billingAccount
     * @return void
     */
    public function restored(BillingAccount $billingAccount)
    {
        //
    }

    /**
     * Handle the billing account "force deleted" event.
     *
     * @param  \App\BillingAccount  $billingAccount
     * @return void
     */
    public function forceDeleted(BillingAccount $billingAccount)
    {
        //
    }
}
