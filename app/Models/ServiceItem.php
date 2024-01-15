<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IHaveCompany;
use App\Interfaces\Models\IHaveCreator;
use App\Models\Traits\Accessors\ServiceItemAccessor;
use App\Models\Traits\Mutators\ServiceItemMutator;
use App\Models\Traits\Relations\ServiceItemRelation;
use App\Models\Traits\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ServiceItem
 *
 * @property int $id
 * @property string $name
 * @property int $company_id
 * @property int $service_category_id
 * @property int|null $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Company $company
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\ServiceCategory $serviceCategory
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem onlyCurrentCompany(?int $companyId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereServiceCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServiceItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ServiceItem extends Model implements IHaveCompany,IHaveCreator,IBaseModel
{ 
    use HasFactory , ServiceItemAccessor,ServiceItemMutator , ServiceItemRelation , CompanyScope    ;
    protected $guarded = [
        'id'
    ];
	protected static function boot()
    {
        parent::boot();
        static::deleted(function ($model) {
			if($model->serviceCategory->serviceItems->count() == 0){
				$model->serviceCategory->delete();
			}
        });
    }
    

}
