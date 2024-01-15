<?php

namespace App\Observers;

use App\Models\SharingLink;

class SharingLinkObserver
{
    public function creating(SharingLink $sharingLink)
    {
        $sharingLink->creator_id = Auth()->user()->id ?? 1 ;
        $sharingLink->company_id = getCurrentCompanyId() ?? 1 ;
    }
}
