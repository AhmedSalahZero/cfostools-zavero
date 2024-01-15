<?php

namespace App\Models;

use App\Models\Traits\Accessors\OtherDirectOperationExpenseAccessor;
use App\Models\Traits\Relations\OtherDirectOperationExpenseRelation;
use App\Traits\HasExpense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherDirectOperationExpense extends Model
{
    use  HasFactory , OtherDirectOperationExpenseRelation  , OtherDirectOperationExpenseAccessor,HasExpense;
    
}
