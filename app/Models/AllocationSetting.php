<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AllocationSetting
 *
 * @method static \Illuminate\Database\Eloquent\Builder|AllocationSetting company()
 * @method static \Illuminate\Database\Eloquent\Builder|AllocationSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AllocationSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AllocationSetting query()
 * @mixin \Eloquent
 */
class AllocationSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'allocation_settings';
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    // Company Scoop
    public function scopeCompany($query)
    {
        return $query->where('company_id', request()->company->id);
    }
}
