<?php
namespace App\Models\Traits\Accessors ;
trait ProductAccessor
{
    public function getId():int
    {
        return $this->id ; 
    }
    public function getName():string 
    {
        return $this->name;
    }
    public function getCompanyId():int
    {
        return $this->company->id ?? 0; 
    }
    public function getCompanyName():string
    {
        return $this->company->getName() ;
    }
	public function getCategoryName()
	{
		return $this->category ? $this->category->getName() : null ;
	}
	
    // public function getCreatorName():string
    // {
    //     return $this->creator->name ?? __('N/A');
    // }
	// public static function getTypes():array 
	// {
	// 	return [
	// 		'direct-manpower-expense'=>__('Direct Manpower Expense'),
	// 		'freelancer-expenses'=>__('Freelancer Expense')
	// 	];
	// }
	
}
