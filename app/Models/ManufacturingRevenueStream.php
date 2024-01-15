<?php

namespace App\Models;

use App\Models\Traits\Accessors\FoodAccessor;
use App\Models\Traits\Accessors\ManufacturingRevenueStreamAccessor;
use App\Models\Traits\Relations\FoodRelation;
use App\Models\Traits\Relations\ManufacturingRevenueStreamRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturingRevenueStream extends Model
{
	use HasFactory, ManufacturingRevenueStreamRelation, ManufacturingRevenueStreamAccessor;
	protected $guarded = [];

	
}
