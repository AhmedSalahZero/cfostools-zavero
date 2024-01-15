<?php

namespace App\Models;

use App\Models\Traits\Accessors\GeneralExpenseAccessor;
use App\Models\Traits\Relations\GeneralExpenseRelation;
use App\Traits\HasExpense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralExpense extends Model
{
    use  HasFactory , GeneralExpenseRelation , GeneralExpenseAccessor,HasExpense;
    
}
