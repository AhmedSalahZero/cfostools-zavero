<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Relations\CategoryRelation;
use App\Models\Traits\Accessors\CategoryAccessor;

class Category extends Model
{
	protected $guarded  = [
		'id'
	];
    use HasFactory , CategoryRelation , CategoryAccessor;
}
