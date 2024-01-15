<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
	protected $guarded = [
		'id'
	];
    
	public function getName()
	{
		return $this->name ;
	}
	public function getExpenseName()
	{
		return $this->getName();
	}
	
	public static function allFormattedForSelect($type,$companyId)
    {
		$expenses = Expense::where('expense_type',$type)->where('company_id',$companyId)->get();
        return formatOptionsForSelect($expenses , 'getExpenseName' , 'getExpenseName');
    }
	public static  function oneFormattedForSelect($model,$type){
		$otherVariableManpowerExpenses = Expense::where('expense_type',$type)->where('company_id',$model->company_id)->get();
        return formatOptionsForSelect($otherVariableManpowerExpenses , 'getName' , 'getName');
	}
	public static function getTypes():array 
	{
		return [
			'other-variable-direct-manpower-expense'=>__('Other Variable Direct Manpower Expense'),
			'other-direct-operations-expense'=>__('Other Direct Operations Expense'),
			'sales-and-market-expense'=>__('Sales And Market Expense'),
			'general-and-administrative-expense'=>__('General & Administrative Expense')
		];
	}
}
