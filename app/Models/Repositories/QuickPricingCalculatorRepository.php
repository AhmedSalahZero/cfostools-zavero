<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\QuickPricingCalculator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class QuickPricingCalculatorRepository implements IBaseRepository 
{
    
    public function all():Collection
    {
        return QuickPricingCalculator::withAllRelations()->onlyCurrentCompany()->get();
    }

    public function allFormatted():array
    {
        return QuickPricingCalculator::onlyCurrentCompany()->get()->pluck('name','id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $quickPricingCalculators = $this->all();
        return formatOptionsForSelect($quickPricingCalculators , 'getId' , 'getName');
    }
  
     public function getAllExcept($id):?Collection
    {
        return QuickPricingCalculator::onlyCurrentCompany()->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return QuickPricingCalculator::onlyCurrentCompany()->query();

    }
    public function Random():Builder
    {
        return QuickPricingCalculator::onlyCurrentCompany()->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return QuickPricingCalculator::onlyCurrentCompany()->find($id);
    }

    public function getLatest($column = 'id'):?QuickPricingCalculator
    {
        return QuickPricingCalculator::onlyCurrentCompany()->latest($column)->first();

    }
     public function store(Request $request ):IBaseModel
    {
        $quickPricingCalculator = App(QuickPricingCalculator::class);
         $quickPricingCalculator
         ->storeOfferedServiceSectionWithResult($request)
         ->storeDirectManpowerExpense($request)
         ->storeFreelancersExpense($request)
         ->storeOtherVariableManpowerExpense($request)
         ->storeOtherDirectOperationsExpense($request)
         ->storeSalesAndMarketingExpense($request)
         ->storeGeneralExpense($request)
         ->storeProfitability($request);
         
         return $quickPricingCalculator ; 
    }
    
    public function update( IBaseModel $quickPricingCalculator , Request $request ):void
    {
        $quickPricingCalculator
        ->updateOfferedServiceSectionWithResult($request)
        ->updateDirectManpowerExpense($request)
        ->updateFreelancersExpense($request)
        ->updateOtherVariableManpowerExpense($request)
        ->updateOtherDirectOperationsExpense($request)
        ->updateSalesAndMarketingExpense($request)
        ->updateGeneralExpense($request)
        ->updateProfitability($request);
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();

        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(QuickPricingCalculator $quickPricingCalculator , $index){
            $quickPricingCalculator->revenueBusinessLineName = $quickPricingCalculator->getRevenueBusinessLineName();
            $quickPricingCalculator->serviceCategoryName = $quickPricingCalculator->getServiceCategoryName();
            $quickPricingCalculator->serviceItemName = $quickPricingCalculator->getServiceItemName();
            $quickPricingCalculator->totalRecommendPriceWithoutVatFormatted = $quickPricingCalculator->getTotalRecommendPriceWithoutVatFormatted();
            $quickPricingCalculator->totalRecommendPriceWithVatFormatted = $quickPricingCalculator->getTotalRecommendPriceWithVatFormatted();
            $quickPricingCalculator->totalNetProfitAfterTaxesFormatted = $quickPricingCalculator->getTotalNetProfitAfterTaxesFormatted();
            $quickPricingCalculator->creator_name = $quickPricingCalculator->getCreatorName();
            $quickPricingCalculator->created_at_formatted = formatDateFromString($quickPricingCalculator->created_at);
            $quickPricingCalculator->updated_at_formatted = formatDateFromString($quickPricingCalculator->updated_at);
            // $quickPricingCalculator->serviceCategories = $quickPricingCalculator->serviceCategories->load('serviceItems'); 
            $quickPricingCalculator->order = $index+1 ;

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> QuickPricingCalculator::onlyCurrentCompany()->count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return QuickPricingCalculator::onlyCurrentCompany()->where(function($q){
			$q->where('pricing_plan_id',null)->orWhere('pricing_plan_id',0);
		})->when($request->filled('search_input') , function(Builder $builder) use ($request){

            $builder
            ->where(function(Builder $builder) use ($request){
                $builder->when($request->filled('search_input'),function(Builder $builder) use ($request){
                    $keyword = "%".$request->get('search_input')."%";
                    $builder
                    ->whereHas('revenueBusinessLine',function(Builder $builder) use ($keyword){
                        $builder->where('revenue_business_lines.name','like',$keyword);
                    })
                    ->orWhereHas('serviceCategory',function(Builder $builder) use ($keyword){
                        $builder->where('service_categories.name','like',$keyword);
                    })
                    ->orWhereHas('serviceCategory',function(Builder $builder) use ($keyword){
                        $builder->where('service_categories.name','like',$keyword);
                    })
                    ->orWhereHas('serviceItem',function(Builder $builder) use ($keyword){
                        $builder->where('service_items.name','like',$keyword);
                    })
                    // ->where('name' , 'like' , $keyword)
                    ->orWhereHas('creator',function(Builder $builder) use($keyword) {
                        $builder->where('name','like',$keyword);
                    })->orWhereHas('company',function(Builder $builder) use($keyword) {
                        $builder->where('name','like',$keyword);
                    })
                    ;
                    
                })
                ;
                
            });
        })
        ->when($request->filled('revenue_business_line_id') && $request->get('revenue_business_line_id') != 'All' , function(Builder $builder) use ($request){
                    // $builder->whereHas('revenueBusinessLine',function(Builder $builder) use ($request){
                        $builder->where('revenue_business_line_id',$request->get('revenue_business_line_id'));
                    // });
                })

                  ->when($request->filled('service_category_id') && $request->get('service_category_id') != 'All' , function(Builder $builder) use ($request){
                    // $builder->whereHas('serviceCategory',function(Builder $builder) use ($request){
                        $builder->where('service_category_id',$request->get('service_category_id'));
                    // });
                })
                ->when($request->filled('service_item_id') && $request->get('service_item_id') != 'All' , function(Builder $builder) use ($request){
                    // $builder->whereHas('serviceItems',function(Builder $builder) use ($request){
                        $builder->where('service_item_id',$request->get('service_item_id'));
                    // });
                })
        
        ->orderBy('quick_pricing_calculators.'.getDefaultOrderBy()['column'],getDefaultOrderBy()['direction']) ;

    }

    public function export(Request $request):Collection
    {
        return $this->commonScope(
            $request->replace(
                array_merge($request->all(),[
                    'format'=>$request->get('format'),
                ]  )
            ))
            ->select(['quick_pricing_calculators.id','revenue_business_line_id','service_category_id','service_item_id','quick_pricing_calculators.created_at as join_at','delivery_days','total_recommend_price_without_vat','total_recommend_price_with_vat','total_net_profit_after_taxes'])
            ->get()->each(function($quickPricingCalculator){
                // $quickPricingCalculator->name = $quickPricingCalculator->getName();
            });
    }






}
