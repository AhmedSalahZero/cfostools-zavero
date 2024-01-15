<?php
namespace App\Models\Traits\Relations ;

use App\Models\Customer;

trait BusinessSectorRelation
{
    public function customers()
    {
        return $this->hasMany(Customer::class , 'business_sector_id' , 'id');
    }
    
}