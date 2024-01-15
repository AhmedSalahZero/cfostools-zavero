<?php

namespace App\Models;

use App\Models\Traits\Accessors\ProductAccessor;
use App\Models\Traits\Relations\ProductRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
	protected $guarded  = [
		'id'
	];
	
    use HasFactory , ProductRelation , ProductAccessor;
}
