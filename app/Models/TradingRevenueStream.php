<?php

namespace App\Models;

use App\Models\Traits\Accessors\ManufacturingRevenueStreamAccessor;
use App\Models\Traits\Accessors\TradingRevenueStreamAccessor;
use App\Models\Traits\Relations\ManufacturingRevenueStreamRelation;
use App\Models\Traits\Relations\TradingRevenueStreamRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradingRevenueStream extends Model
{
	use HasFactory, TradingRevenueStreamRelation, TradingRevenueStreamAccessor;
	protected $guarded = [];

	
}
