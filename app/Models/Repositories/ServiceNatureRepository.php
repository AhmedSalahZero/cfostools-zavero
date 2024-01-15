<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\ServiceNature;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ServiceNatureRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return ServiceNature::get();
    }

    public function allFormatted():array
    {
        return ServiceNature::get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $serviceNatures = $this->all();
        return formatOptionsForSelect($serviceNatures , 'getId' , 'getName');
    }
       public function oneFormattedForSelect($model)
    {
        $serviceNatures = ServiceNature::where('id',$model->getServiceNatureId())->get();
        return formatOptionsForSelect($serviceNatures , 'getId' , 'getName');
    }
    
     public function allCurrentServiceNatureServiceNatures():array
    {
        return ServiceNature::get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
     public function getAllExcept($id):?Collection
    {
        return ServiceNature::where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return ServiceNature::query();

    }
    public function Random():Builder
    {
        return ServiceNature::inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return ServiceNature::find($id);
    }

    public function getLatest($column = 'id'):?ServiceNature
    {
        return ServiceNature::latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        
        return ServiceNature::create([
            'name'=>$request->get('service_item_name'),
            'service_category_id'=>$request->get('service_category_id'),
            // 'revenue_business_line_id'=>$request->get('revenue_business_line_id')
        ]);
    }




    public function update( IBaseModel $serviceNature , Request $request ):void
    {
        $serviceNature->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(ServiceNature $serviceNature){
            $serviceNature['name_'.App()->getLocale()] = $serviceNature->getName();
            $serviceNature->companyName = $serviceNature->getCompanyName();
            $serviceNature->creator_name = $serviceNature->getCreatorName();
            $serviceNature->created_at_formatted = formatDateFromString($serviceNature->created_at);

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> ServiceNature::count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return ServiceNature::when($request->filled('search_input') , function(Builder $builder) use ($request){

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
            ->get()->each(function($serviceNature){

                $serviceNature->name_en = $serviceNature->getName();
                $serviceNature->company_id = $serviceNature->getCompanyId();
                $serviceNature->join_at = formatDateFromString($serviceNature->join_at);

            });


    }






}
