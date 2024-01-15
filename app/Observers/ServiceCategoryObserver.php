<?php

namespace App\Observers;

use App\Models\ServiceCategory;

class ServiceCategoryObserver
{
    public function creating(ServiceCategory $serviceCategory)
    {
        $serviceCategory->creator_id = Auth()->user()->id ?? 1 ;
        $serviceCategory->company_id = getCurrentCompanyId() ?? 1 ;
    }
}
