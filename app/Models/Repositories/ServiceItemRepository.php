<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\ServiceItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ServiceItemRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return ServiceItem::onlyCurrentCompany()->get();
    }

    public function allFormatted():array
    {
        return ServiceItem::onlyCurrentCompany()->get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $serviceItems = $this->all();
        return formatOptionsForSelect($serviceItems , 'getId' , 'getName');
    }
       public function oneFormattedForSelect($model)
    {
        $serviceItems = ServiceItem::where('id',$model->getServiceItemId())->get();
        return formatOptionsForSelect($serviceItems , 'getId' , 'getName');
    }
    
     public function allCurrentServiceItemServiceItems():array
    {
        return ServiceItem::onlyCurrentCompany()->get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
     public function getAllExcept($id):?Collection
    {
        return ServiceItem::onlyCurrentCompany()->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return ServiceItem::onlyCurrentCompany()->query();

    }
    public function Random():Builder
    {
        return ServiceItem::onlyCurrentCompany()->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return ServiceItem::onlyCurrentCompany()->find($id);
    }

    public function getLatest($column = 'id'):?ServiceItem
    {
        return ServiceItem::onlyCurrentCompany()->latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        
        return ServiceItem::create([
            'name'=>$request->get('service_item_name'),
            'service_category_id'=>$request->get('service_category_id'),
            // 'revenue_business_line_id'=>$request->get('revenue_business_line_id')
        ]);
    }




    public function update( IBaseModel $serviceItem , Request $request ):void
    {
        $serviceItem->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(ServiceItem $serviceItem){
            $serviceItem['name_'.App()->getLocale()] = $serviceItem->getName();
            $serviceItem->companyName = $serviceItem->getCompanyName();
            $serviceItem->creator_name = $serviceItem->getCreatorName();
            $serviceItem->created_at_formatted = formatDateFromString($serviceItem->created_at);

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> ServiceItem::onlyCurrentCompany()->count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return ServiceItem::onlyCurrentCompany()->when($request->filled('search_input') , function(Builder $builder) use ($request){

            $builder
            ->where(function(Builder $builder) use ($request){
                $builder->when($request->filled('search_input'),function(Builder $builder) use ($request){
                    $keyword = "%".$request->get('search_input')."%";
                    $builder->where('name_'.App()->getLocale() , 'like' , $keyword)
                    ->orWhereHas('creator',function(Builder $builder) use($keyword) {
                        $builder->where('name','like',$keyword);
                    })->orWhereHas('company',function(Builder $builder) use($keyword) {
                        $builder->where('name_'.App()->getLocale(),'like',$keyword);
                    })
                    ;
                    
                })
                ;
                
            });
        })->when($request->filled('company_id') , function(Builder $builder) use ($request){
                    $builder->whereHas('company',function(Builder $builder) use ($request){
                        $builder->where('companies.id',$request->get('company_id'));
                    });
                })
        
        ->orderBy(getDefaultOrderBy()['column'],getDefaultOrderBy()['direction']) ;

    }

    public function export(Request $request):Collection
    {
        return $this->commonScope(
            $request->replace(
                [
                    'format'=>$request->get('format'),
                    'company_id'=>$request->get('company_id'),
                ]
            ))
            ->select(['id','name_en','company_id','created_at as join_at'])
            ->get()->each(function($serviceItem){

                $serviceItem->name_en = $serviceItem->getName();
                $serviceItem->company_id = $serviceItem->getCompanyId();
                $serviceItem->join_at = formatDateFromString($serviceItem->join_at);

            });


    }






}
