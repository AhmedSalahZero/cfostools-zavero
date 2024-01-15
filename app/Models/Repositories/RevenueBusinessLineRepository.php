<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\RevenueBusinessLine;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RevenueBusinessLineRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return RevenueBusinessLine::onlyCurrentCompany()->forCurrentCompany()->get();
    }

    public function allFormatted():array
    {
        return RevenueBusinessLine::onlyCurrentCompany()->forCurrentCompany()->get()->pluck('name','id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $revenueBusinessLines = $this->all();
        return formatOptionsForSelect($revenueBusinessLines , 'getId' , 'getName');
    }

     public function oneFormattedForSelect($model)
    {
        $revenueBusinessLines = RevenueBusinessLine::where('id',$model->getRevenueBusinessLineId())->get();
        return formatOptionsForSelect($revenueBusinessLines , 'getId' , 'getName');
    }
    
  
     public function getAllExcept($id):?Collection
    {
        return RevenueBusinessLine::onlyCurrentCompany()->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return RevenueBusinessLine::onlyCurrentCompany()->query();

    }
    public function Random():Builder
    {
        return RevenueBusinessLine::onlyCurrentCompany()->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return RevenueBusinessLine::onlyCurrentCompany()->find($id);
    }

    public function getLatest($column = 'id'):?RevenueBusinessLine
    {
        return RevenueBusinessLine::onlyCurrentCompany()->latest($column)->first();

    }
     public function store(Request $request ):IBaseModel
    {
		$serviceItemId = $request->get('service_item_id') ;
		$revenueBusinessLine = null;
        if(! \is_numeric($serviceItemId))
        {
			$revenueBusinessLineId = $request->get('revenue_business_line_id') ;
			$serviceCategoryId = $request->get('service_category_id') ;
			$serviceItemId = $request->get('service_item_id') ;
			$name = $request->get('revenue_business_line_name') ;
			
			 $revenueBusinessLineId =  is_numeric($revenueBusinessLineId) ? $revenueBusinessLineId 
                :  $revenueBusinessLine =   RevenueBusinessLine::create([
					'name'=>$name,
					'company_id'=>$request->get('company_id'),
					'creator_id'=>auth()->user()->id 
				]);
				$revenueBusinessLineId =  is_numeric($revenueBusinessLineId) ? $revenueBusinessLineId : $revenueBusinessLine->id ; 
				
				 $serviceCategoryId =  is_numeric($serviceCategoryId) ? $serviceCategoryId 
                : App(ServiceCategoryRepository::class)->store($request->replace(array_merge($request->all() , ['revenue_business_line_id'=>$revenueBusinessLineId])))->id;
				
			
			
            foreach(Arr::flatten($request->service_item) as $serviceItemName)
            {
				  App(ServiceItemRepository::class)->store($request->replace(array_merge($request->all() , ['revenue_business_line_id'=>$revenueBusinessLineId , 'service_category_id'=>$serviceCategoryId , 'service_item_name'=>$serviceItemName ])));
                // $revenueBusinessLine = $this->createRecord($request , $serviceItemName );
            }
        }
        else{
			
            $revenueBusinessLine = $this->createRecord($request);
        }
        return $revenueBusinessLine ;
    }

    public function createRecord(Request $request  , $serviceItemName = null  ):RevenueBusinessLine
    {
        $revenueBusinessLineId = $request->get('revenue_business_line_id') ;
        $serviceCategoryId = $request->get('service_category_id') ;
        $serviceItemId = $request->get('service_item_id') ;
		$name = $request->get('revenue_business_line_name') ;
        return RevenueBusinessLine::create([
                'revenue_business_line_id'=> $revenueBusinessLineId =  is_numeric($revenueBusinessLineId) ? $revenueBusinessLineId 
                : $revenueBusinessLineId = RevenueBusinessLine::create([
					'name'=>$name,
					'company_id'=>$request->get('company_id'),
					'creator_id'=>auth()->user()->id 
				])->id   ,
                'service_category_id'=> $serviceCategoryId =  is_numeric($serviceCategoryId) ? $serviceCategoryId 
                : App(ServiceCategoryRepository::class)->store($request->replace(array_merge($request->all() , ['revenue_business_line_id'=>$revenueBusinessLineId])))->id,
                'service_item_id'=> is_numeric($serviceItemId) ? $serviceItemId 
                : App(ServiceItemRepository::class)->store($request->replace(array_merge($request->all() , ['revenue_business_line_id'=>$revenueBusinessLineId , 'service_category_id'=>$serviceCategoryId , 'service_item_name'=>$serviceItemName ])))->id              
            ]);
    }



    // public function detach(IHaveRevenueBusinessLinesModel $iHaveRevenueBusinessLinesModel):void
    // {
    //     $iHaveRevenueBusinessLinesModel->revenueBusinessLines()->detach();
    // }
    public function update( IBaseModel $revenueBusinessLine , Request $request ):void
    {
        $revenueBusinessLine->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();

        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(RevenueBusinessLine $revenueBusinessLine , $index){
            $revenueBusinessLine->revenueBusinessLineName = $revenueBusinessLine->getName();
            $revenueBusinessLine->creator_name = $revenueBusinessLine->getCreatorName();
            $revenueBusinessLine->created_at_formatted = formatDateFromString($revenueBusinessLine->created_at);
            $revenueBusinessLine->updated_at_formatted = formatDateFromString($revenueBusinessLine->updated_at);
            $revenueBusinessLine->serviceCategories = $revenueBusinessLine->serviceCategories->load('serviceItems'); 
            $revenueBusinessLine->order = $index+1 ;

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> RevenueBusinessLine::onlyCurrentCompany()->count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return RevenueBusinessLine::onlyCurrentCompany()->when($request->filled('search_input') , function(Builder $builder) use ($request){

            $builder
            ->where(function(Builder $builder) use ($request){
                $builder->when($request->filled('search_input'),function(Builder $builder) use ($request){
                    $keyword = "%".$request->get('search_input')."%";
                    $builder->where('name' , 'like' , $keyword)
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
                    // $builder->whereHas('company',function(Builder $builder) use ($request){
                        $builder->where('id',$request->get('revenue_business_line_id'));
                    // });
                })

                  ->when($request->filled('service_category_id') && $request->get('service_category_id') != 'All' , function(Builder $builder) use ($request){
                    $builder->whereHas('serviceCategories',function(Builder $builder) use ($request){
                        $builder->where('id',$request->get('service_category_id'));
                    });
                })
                ->when($request->filled('service_item_id') && $request->get('service_item_id') != 'All' , function(Builder $builder) use ($request){
                    $builder->whereHas('serviceItems',function(Builder $builder) use ($request){
                        $builder->where('service_items.id',$request->get('service_item_id'));
                    });
                })
        
        ->orderBy(getDefaultOrderBy()['column'],getDefaultOrderBy()['direction']) ;

    }

    public function export(Request $request):Collection
    {
        return $this->commonScope(
            $request->replace(
                array_merge($request->all(),[
                    'format'=>$request->get('format'),
                ]  )
            ))
            ->select(['id','name','company_id','created_at as join_at'])
            ->get()->each(function($revenueBusinessLine){

                $revenueBusinessLine->name = $revenueBusinessLine->getName();
                // $revenueBusinessLine->company_id = $revenueBusinessLine->getCompanyId();
                // $revenueBusinessLine->join_at = formatDateFromString($revenueBusinessLine->join_at);

            });


    }






}
