<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\BusinessSector;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BusinessSectorRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return BusinessSector::onlyCurrentCompany()->get();
    }

    public function allFormatted():array
    {
        return BusinessSector::onlyCurrentCompany()->get()->pluck('name','id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $businessSectors = $this->all();
        
        return formatOptionsForSelect($businessSectors , 'getId' , 'getName');
    }
    
     public function oneFormattedForSelect($model)
    {
        $businessSectors = BusinessSector::where('id',$model->getBusinessSectorId())->get();
        return formatOptionsForSelect($businessSectors , 'getId' , 'getNameAndType');
    }
    
  
     public function getAllExcept($id):?Collection
    {
        return BusinessSector::onlyCurrentCompany()->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return BusinessSector::onlyCurrentCompany()->query();

    }
    public function Random():Builder
    {
        return BusinessSector::onlyCurrentCompany()->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return BusinessSector::onlyCurrentCompany()->find($id);
    }

    public function getLatest($column = 'id'):?BusinessSector
    {
        return BusinessSector::onlyCurrentCompany()->latest($column)->first();

    }
     public function store(Request $request ):IBaseModel
    {
        $businessSector = BusinessSector::create([
            'name'=>$request->get('business_sector_name'),
            'company_id'=>\getCurrentCompanyId(),
            'creator_id'=>Auth()->user()->id 
        ]);
        
        return $businessSector ;
    }



    public function update( IBaseModel $businessSector , Request $request ):void
    {
        $businessSector->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();

// dd(Request('length'));
        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(BusinessSector $businessSector , $index){
            $businessSector->businessSectorName = $businessSector->getName();
            $businessSector->creator_name = $businessSector->getCreatorName();
            $businessSector->created_at_formatted = formatDateFromString($businessSector->created_at);
            $businessSector->updated_at_formatted = formatDateFromString($businessSector->updated_at);
            $businessSector->serviceCategories = $businessSector->serviceCategories->load('serviceItems'); 
            $businessSector->order = $index+1 ;

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> BusinessSector::onlyCurrentCompany()->count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return BusinessSector::onlyCurrentCompany()->when($request->filled('search_input') , function(Builder $builder) use ($request){

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
            ->get()->each(function($businessSector){

                $businessSector->name = $businessSector->getName();
                // $businessSector->company_id = $businessSector->getCompanyId();
                // $businessSector->join_at = formatDateFromString($businessSector->join_at);

            });


    }






}
