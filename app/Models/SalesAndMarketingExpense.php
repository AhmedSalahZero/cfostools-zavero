<?php

namespace App\Models;

use App\Models\Traits\Accessors\SalesAndMarketingExpenseAccessor;
use App\Models\Traits\Relations\SalesAndMarketingExpenseRelation;
use App\Traits\HasExpense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAndMarketingExpense extends Model
{
    use  HasFactory , SalesAndMarketingExpenseRelation , SalesAndMarketingExpenseAccessor , HasExpense ;
    
}
