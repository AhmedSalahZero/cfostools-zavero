<?php
namespace App\Models\Traits\Relations ;

use App\Models\Traits\Relations\Commons\CommonRelations;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait SharingLinkRelation
{
    use CommonRelations ;
    
    public function shareable():MorphTo
    {
        return $this->morphTo();
    }
    
}