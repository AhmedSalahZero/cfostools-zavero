<?php

namespace App\Models;

use App\Traits\StaticBoot;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\SalesGatheringTest
 *
 * @method static Builder|SalesGatheringTest company()
 * @method static Builder|SalesGatheringTest newModelQuery()
 * @method static Builder|SalesGatheringTest newQuery()
 * @method static Builder|SalesGatheringTest query()
 * @mixin \Eloquent
 */
class UploadExcelTest extends Model
{
     use StaticBoot;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_gathering_tests';

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompany($query)
    {
        return $query->where('company_id', request()->company->id);
    }
    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public function scopeWithoutValidation($query)
    // {
    //     return $query->except(['validation']);
    // }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'validation' => 'array',
    ];
}
