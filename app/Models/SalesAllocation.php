<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesAllocation extends Model
{
	protected $guarded = [
		'id'
	];
    
	public function getName()
	{
		return $this->name ;
	}
	
	public static function allFormattedForSelect($type,$companyId)
    {
		$allocationTypes = self::where('type',$type)->where('company_id',$companyId)->get();
        return formatOptionsForSelect($allocationTypes , 'getName' , 'getName');
    }
	// public static  function oneFormattedForSelect($model,$type){
	// 	$otherVariableManpowerExpenses = Expense::where('expense_type',$type)->where('company_id',$model->company_id)->get();
    //     return formatOptionsForSelect($otherVariableManpowerExpenses , 'getName' , 'getName');
	// }
	public static function getTypes():array 
	{
		return [
			'sales-channel'=>__('Sales Channels'),
			'business-sector'=>__('Business Sectors'),
			'zone'=>__('Zones'),
			'branch'=>__('Branches')
		];
	}
}
