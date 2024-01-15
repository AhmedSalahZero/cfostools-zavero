<?php
namespace App\Models\Traits\Relations ;

use App\Models\BusinessSector;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CustomerRelation
{
    public function businessSector():BelongsTo
    {
        return $this->belongsTo(BusinessSector::class ,'business_sector_id','id');
    }
    
}