<?php

namespace App\Models;

use App\Models\Traits\Accessors\CasinoAccessor;
use App\Models\Traits\Relations\CasinoRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casino extends Model
{
	use HasFactory, CasinoRelation, CasinoAccessor;
	protected $guarded = [];
	protected $casts = [
		'guest_capture_cover_percentage'=>'array',
		'meal_per_guest'=>'array',
		'cover_per_day'=>'array',
		'percentage_from_rooms_revenues'=>'array'
	];
}
