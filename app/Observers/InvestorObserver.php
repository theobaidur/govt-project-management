<?php

namespace App\Observers;

use App\Models\BillingAccount;
use App\Models\Investor;

class InvestorObserver
{
    /**
     * Handle the investor "created" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function created(Investor $investor)
    {
        $user = $investor->user->first_name.' '.$investor->user->last_name;
        $billingAccounts[] = [
            'name'=> $user,
            'account_type'=> 'project-investor',
            'project_id'=> $investor->project_id
        ];
        BillingAccount::insert($billingAccounts);
    }

    /**
     * Handle the investor "updated" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function updated(Investor $investor)
    {
        //
    }

    /**
     * Handle the investor "deleted" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function deleted(Investor $investor)
    {
        //
    }

    /**
     * Handle the investor "restored" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function restored(Investor $investor)
    {
        //
    }

    /**
     * Handle the investor "force deleted" event.
     *
     * @param  \App\Investor  $investor
     * @return void
     */
    public function forceDeleted(Investor $investor)
    {
        //
    }
}
