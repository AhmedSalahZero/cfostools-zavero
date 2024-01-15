<?php

namespace App\Models\Traits\Accessors;

trait TradingRevenueStreamAccessor
{
	public function getId(): int
	{
		return $this->id;
	}
	public function getProductId()
	{
		return $this->product ? $this->product->id : 0 ;
	}
	public function getCategoryId()
	{
		return $this->category ? $this->category->id : 0 ;
	}
	public function getSellingUOM()
	{
		return $this->selling_uom ; 
	}
	public function getProductionUOM()
	{
		return $this->production_uom ; 
	}
	public function getProductToSellingConverter()
	{
		return $this->product_to_selling_converter ; 
	}
	public function getSellingStartDate()
	{
		return $this->selling_start_date ; 
	}
	
	
	
}
