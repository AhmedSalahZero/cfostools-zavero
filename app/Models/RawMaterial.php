<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
	// protected $table ='expense';
	
	protected $guarded = ['id'];
	
	protected $casts = [
		// 'payload'=>'array',
		// 'custom_collection_policy'=>'array'
	];
	
	public function company()
	{
		return $this->belongsTo(Company::class , 'company_id','id');
	}
	public function model()
	{
		$modelName = '\App\Models\\'.$this->model_name ;
		return $this->belongsTo($modelName , 'model_id','id');	
	}
	public function product()
	{
		return $this->belongsTo(Product::class , 'product_id','id');
	}
	public function getName()
	{
		return $this->name ;
	}
	public function getQuantity()
	{
		return $this->quantity?:0 ;
	}
	public function getTotalQuantity()
	{
		return $this->total_quantity ?:0 ;
	}
	public function getWasteRate()
	{
		return $this->waste_rate ?: 0 ;
	}
	public function getProductUnitOfMeasurementId()
	{
		return $this->product_unit_of_measurement_id;
	}
	
}
