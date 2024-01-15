<?php

namespace App\Models;

use App\Models\Traits\Accessors\SalesChannelAccessor;
use App\Models\Traits\Relations\SalesChannelRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesChannel extends Model
{
	protected $table = 'saleschannels';

	use HasFactory, SalesChannelRelation, SalesChannelAccessor;
	protected $guarded = [];

}
