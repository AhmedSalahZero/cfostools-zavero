<?php

namespace App\Models;

use App\Traits\StaticBoot;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SalesGathering
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $date
 * @property int|null $Year
 * @property int|null $Month
 * @property int|null $Day
 * @property string|null $country
 * @property string|null $local_or_export
 * @property string|null $branch
 * @property string|null $document_type
 * @property string|null $document_number
 * @property string|null $sales_person
 * @property string|null $customer_code
 * @property string|null $customer_name
 * @property string|null $business_sector
 * @property string|null $zone
 * @property string|null $sales_channel
 * @property string|null $service_provider_type
 * @property string|null $service_provider_name
 * @property int|null $service_provider_birth_year
 * @property string|null $principle
 * @property string|null $category
 * @property string|null $sub_category
 * @property string|null $product_or_service
 * @property string|null $product_item
 * @property string|null $measurment_unit
 * @property string|null $return_reason
 * @property string|null $quantity
 * @property string|null $quantity_status
 * @property string|null $quantity_bonus
 * @property string|null $price_per_unit
 * @property string|null $sales_value
 * @property string|null $quantity_discount
 * @property string|null $cash_discount
 * @property string|null $special_discount
 * @property string|null $other_discounts
 * @property string|null $net_sales_value
 * @property string|null $updated_by
 * @property string|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $min_year
 * @property string|null $prev_year
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering company()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereBusinessSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCashDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCustomerCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereLocalOrExport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereMeasurmentUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereMinYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereNetSalesValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereOtherDiscounts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering wherePrevYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering wherePricePerUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering wherePrinciple($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereProductItem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereProductOrService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereQuantityBonus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereQuantityDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereQuantityStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereReturnReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSalesChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSalesPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSalesValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereServiceProviderBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereServiceProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereServiceProviderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSpecialDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereSubCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalesGathering whereZone($value)
 * @mixin \Eloquent
 */
class SalesGathering extends Model
{
    use StaticBoot;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */

    protected $guarded = [];


    //  protected $connection= 'mysql2';
    // protected $table = 'sales_gathering';
    // protected $primaryKey  = 'user_id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales_gathering';
    public function scopeCompany($query)
    {
        return $query->where('company_id', request()->company->id?? Request('company_id') );
    }
}
