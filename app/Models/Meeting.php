<?php

namespace App\Models;

use App\Models\Traits\Accessors\MeetingAccessor;
use App\Models\Traits\Relations\MeetingRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
	use HasFactory, MeetingRelation, MeetingAccessor;
	protected $guarded = [];
	protected $casts = [
		'rent_seasonality'=>'array',
		'guest_seasonality'=>'array',
		'guest_capture_cover_percentage'=>'array',
		'percentage_from_f_and_b_revenues'=>'array'
	];
}
