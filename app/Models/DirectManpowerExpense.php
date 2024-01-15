<?php

namespace App\Models;

use App\Models\Traits\Accessors\DirectManpowerExpenseAccessor;
use App\Models\Traits\Mutators\DirectManpowerExpenseMutator;
use App\Models\Traits\Relations\DirectManpowerExpenseRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectManpowerExpense extends Model
{
    use  HasFactory , DirectManpowerExpenseRelation , DirectManpowerExpenseAccessor , DirectManpowerExpenseMutator;
    
}
