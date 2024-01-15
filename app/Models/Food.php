<?php

namespace App\Models;

use App\Models\Traits\Accessors\FoodAccessor;
use App\Models\Traits\Relations\FoodRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
	use HasFactory, FoodRelation, FoodAccessor;
	protected $guarded = [];
	protected $table  = 'foods';
	protected $casts = [
		'guest_capture_cover_percentage'=>'array',
		'meal_per_guest'=>'array',
		'cover_per_day'=>'array',
		'percentage_from_rooms_revenues'=>'array'
	];
	
}
