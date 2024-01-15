<?php
namespace App\Models\Traits\Relations ;

use App\Models\Category;

trait ProductRelation
{
   public function category()
   {
		return $this->belongsTo(Category::class , 'category_id','id');
   }
}
