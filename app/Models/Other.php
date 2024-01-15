<?php

namespace App\Models;

use App\Models\Traits\Accessors\OtherAccessor;
use App\Models\Traits\Relations\OtherRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Other extends Model
{

	use HasFactory, OtherRelation, OtherAccessor;
	protected $guarded = [];
	protected $casts = [
		'guest_capture_cover_percentage'=>'array',
		'percentage_from_rooms_revenues'=>'array'
	];
}
