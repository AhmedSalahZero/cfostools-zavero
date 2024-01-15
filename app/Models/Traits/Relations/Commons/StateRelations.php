<?php 
namespace App\Models\Traits\Relations\Commons;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait StateRelations
{
    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class ,'country_id','id');
    }
    public function state():BelongsTo
    {
        return $this->belongsTo(State::class ,'state_id' ,'id');
    }
    
}