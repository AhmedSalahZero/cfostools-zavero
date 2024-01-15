<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\StaticBoot;
/**
 * App\Models\CustomersInvoice
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CustomersInvoice company()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomersInvoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomersInvoice newQuery()
 * @method static \Illuminate\Database\Query\Builder|CustomersInvoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomersInvoice query()
 * @method static \Illuminate\Database\Query\Builder|CustomersInvoice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CustomersInvoice withoutTrashed()
 * @mixin \Eloquent
 */
class CustomersInvoice extends Model
{
    use SoftDeletes,StaticBoot;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = [];
    /**
     * Get the
     *
     * @param  string  $value
     * @return string
     */


    public function scopeCompany($query)
    {
        return $query->where('company_id', request()->company->id);
    }

}
