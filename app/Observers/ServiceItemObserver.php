<?php

namespace App\Observers;

use App\Models\ServiceItem;

class ServiceItemObserver
{
    public function creating(ServiceItem $serviceItem)
    {
        $serviceItem->creator_id = Auth()->user()->id ?? 1 ;
        $serviceItem->company_id = getCurrentCompanyId() ?? 1 ;
    }
}
