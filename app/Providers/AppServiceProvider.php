<?php

namespace App\Providers;

use App\Models\Investor;
use App\Models\InvoiceItem;
use App\Models\Project;
use App\Observers\InvestorObserver;
use App\Observers\InvoiceItemObserver;
use App\Observers\ProjectObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Project::observe(ProjectObserver::class);
        Investor::observe(InvestorObserver::class);
        InvoiceItem::observe(InvoiceItemObserver::class);
    }
}
