<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IHaveCompany;
use App\Interfaces\Models\IHaveCreator;
use App\Models\Traits\Accessors\ServiceCategoryAccessor;
use App\Models\Traits\Mutators\ServiceCategoryMutator;
use App\Models\Traits\Relations\ServiceCategoryRelation;
use App\Models\Traits\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceCategory
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int $revenue_business_line_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RevenueBusinessLine $RevenueBusinessLine
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\QuickPricingCalculator[] $quickPricingCalculator
 * @property-read int|null $quick_pricing_calculator_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceItem[] $serviceItems
 * @property-read int|null $service_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereRevenueBusinessLineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServiceCategory extends Model implements IHaveCompany,IHaveCreator,IBaseModel
{ 
    use HasFactory , ServiceCategoryAccessor,ServiceCategoryMutator , ServiceCategoryRelation, CompanyScope    ;
    protected $guarded = [
        'id'
    ];
	protected static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
			if($model->RevenueBusinessLine && $model->RevenueBusinessLine->serviceCategories->count() == 0){
				$model->RevenueBusinessLine->delete();
			}
        });
    }
    

}
