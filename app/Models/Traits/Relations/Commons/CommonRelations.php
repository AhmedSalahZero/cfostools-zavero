<?php 
namespace App\Models\Traits\Relations\Commons;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CommonRelations
{
     public function company():BelongsTo
    {
        return $this->belongsTo(Company::class , 'company_id','companies.id');
    }
    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class ,'creator_id','id');
    }
}
