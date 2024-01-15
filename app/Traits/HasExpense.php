<?php
namespace App\Traits;

use App\Models\Expense;

trait HasExpense
{
	public function expense()
	{
		return $this->belongsTo(Expense::class , 'expense_id','id');
	}
	public function getExpenseName()
	{
		return $this->expense ? $this->expense->name : null ;
	}
}
