<?php
namespace App\Models\Traits\Relations ;

use App\Models\Product;

trait CategoryRelation
{
	public function products()
	{
		return $this->hasMay(Product::class , 'category_id','id');
	}
}
