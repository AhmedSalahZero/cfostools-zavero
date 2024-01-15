<?php

namespace App\Models;

use App\Models\Traits\Accessors\RoomAccessor;
use App\Models\Traits\Relations\RoomRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
	use HasFactory, RoomRelation, RoomAccessor;
	protected $guarded = [];
	
	
}
