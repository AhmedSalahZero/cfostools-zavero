<?php

namespace App\Observers;

use App\Models\RevenueBusinessLine;

class RevenueBusinessLineObserver
{
    public function creating(RevenueBusinessLine $revenueBusinessLine)
    {
        $revenueBusinessLine->creator_id = Auth()->user()->id ?? 1 ;
        $revenueBusinessLine->company_id = getCurrentCompanyId() ?? 1 ;
    }
}
