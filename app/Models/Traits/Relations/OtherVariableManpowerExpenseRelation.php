<?php
namespace App\Models\Traits\Relations ;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait OtherVariableManpowerExpenseRelation
{
    public function otherVariableManpowerExpenseAble():MorphTo
    {
        return $this->morphTo();
    }
		
    
}
