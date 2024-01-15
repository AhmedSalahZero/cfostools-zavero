<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IExportable;
use App\Interfaces\Models\IHaveCompany;
use App\Interfaces\Models\IHaveCreator;
use App\Interfaces\Models\IHaveView;
use App\Models\Repositories\RevenueBusinessLineRepository;
use App\Models\Repositories\ServiceCategoryRepository;
use App\Models\Repositories\ServiceItemRepository;
use App\Models\Repositories\ServiceNatureRepository;
use App\Models\Traits\Accessors\RevenueBusinessLineAccessor;
use App\Models\Traits\Mutators\RevenueBusinessLineMutator;
use App\Models\Traits\Relations\RevenueBusinessLineRelation;
use App\Models\Traits\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevenueBusinessLine extends Model implements IHaveView,IHaveCompany,IHaveCreator,IBaseModel , IExportable
{ 
    use HasFactory , RevenueBusinessLineAccessor,RevenueBusinessLineMutator , RevenueBusinessLineRelation   , CompanyScope ;
    protected $guarded = [
        'id'
    ];
    
    public static function getFileName():string 
    {
        return __('Revenue Business Line');
    }
    
    public static function exportViewName():string {
        return __('Revenue Business Line'); 
    }
    
    public static function getViewVars():array 
    {
        $currentCompanyId = \getCurrentCompany()->getIdentifier() ;
        return [
            'getDataRoute'=>route('admin.get.revenue-business-line' , ['company'=>getCompanyId()]) ,
            'modelName'=>'RevenueBusinessLine',
            // 'companies'=>App(CompanyRepository::class)->allFormatted(),
            'exportRoute'=>route('admin.export.revenue-business-line' , $currentCompanyId),
            'createRoute'=>route('admin.create.revenue-business-line',$currentCompanyId),
            'pageTitle'=>__('Revenue Business Line'),
              'revenueBusinessLines'=>App(RevenueBusinessLineRepository::class)->allFormattedForSelect($currentCompanyId),
            'serviceCategories'=>App(ServiceCategoryRepository::class)->allFormattedForSelect($currentCompanyId),
            'serviceItems'=>App(ServiceItemRepository::class)->allFormattedForSelect($currentCompanyId)
        ];
    }
    
    public function scopeForCurrentCompany(Builder $builder)
    {
        return $builder->where('company_id' , \getCurrentCompany()->id);
    }
	public static function removeUnusedCategories()
	{
		$companyId = getCurrentCompanyId();
		$serviceCategories = ServiceCategory::where('company_id',$companyId)->get();
		foreach($serviceCategories as $serviceCategory){
			if(!$serviceCategory->serviceItems->count()){
				try{
					$serviceCategory->delete();
				}
				catch(\Exception $e){
					
				}
			}
		}
		$revenueBusinessLines = RevenueBusinessLine::where('company_id',$companyId)->get();
		foreach($revenueBusinessLines as $revenueBusinessLine){
			if(!$revenueBusinessLine->serviceCategories->count()){
				try{
					$revenueBusinessLine->delete();
				}
				catch(\Exception $e){
					
				}
			}
		}
	}
}
