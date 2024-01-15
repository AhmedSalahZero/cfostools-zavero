<?php

namespace App\Models;

use App\Models\Traits\Accessors\PositionAccessor;
use App\Models\Traits\Relations\PositionRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Position extends Model
{
	protected $guarded  = [
		'id'
	];
    use HasFactory , PositionRelation , PositionAccessor;
}
