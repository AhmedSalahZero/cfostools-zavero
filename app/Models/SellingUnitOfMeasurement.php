<?php

namespace App\Models;

use App\Models\Traits\Accessors\SellingUnitOfMeasurementAccessor;
use App\Models\Traits\Relations\SellingUnitOfMeasurementRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingUnitOfMeasurement extends Model
{
	protected $guarded  = [
		'id'
	];
    use HasFactory , SellingUnitOfMeasurementRelation , SellingUnitOfMeasurementAccessor;
}
