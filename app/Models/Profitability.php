<?php

namespace App\Models;

use App\Models\Traits\Accessors\ProfitabilityAccessor;
use App\Models\Traits\Relations\GeneralExpenseRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profitability extends Model
{
    use  HasFactory , GeneralExpenseRelation , ProfitabilityAccessor;
    
    protected $guarded = ['id'];
}
