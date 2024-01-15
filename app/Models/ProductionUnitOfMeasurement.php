<?php

namespace App\Models;

use App\Models\Traits\Accessors\ProductionUnitOfMeasurementAccessor;
use App\Models\Traits\Relations\ProductionUnitOfMeasurementRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionUnitOfMeasurement extends Model
{
	protected $guarded  = [
		'id'
	];
    use HasFactory , ProductionUnitOfMeasurementRelation , ProductionUnitOfMeasurementAccessor;
	
	public static function getNameById($id){
		return static::where('id',$id)->first() ? static::where('id',$id)->first()->getName() : null;
	}
}
