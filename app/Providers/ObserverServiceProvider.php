<?php

namespace App\Providers;

use App\Models\HospitalitySector;
use App\Models\RevenueBusinessLine;
use App\Models\ServiceCategory;
use App\Models\ServiceItem;
use App\Models\SharingLink;
use App\Observers\RevenueBusinessLineObserver;
use App\Observers\ServiceCategoryObserver;
use App\Observers\ServiceItemObserver;
use App\Observers\SharingLinkObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
   
    public function boot()
    {       
        RevenueBusinessLine::observe(RevenueBusinessLineObserver::class);
        ServiceCategory::observe(ServiceCategoryObserver::class);
        ServiceItem::observe(ServiceItemObserver::class);
        SharingLink::observe(SharingLinkObserver::class);
    }
}
