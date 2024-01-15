<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueStreamType extends Model
{
    protected $guarded=[];

    public function categoryProducts($company_id)
    {
    	return $this->hasMany(CategoryProduct::class)->where('company_id',$company_id)->get();
    }
}
