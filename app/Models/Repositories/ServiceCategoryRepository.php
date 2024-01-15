<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ServiceCategoryRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return ServiceCategory::onlyCurrentCompany()->get();
    }

    public function allFormatted():array
    {
        return ServiceCategory::onlyCurrentCompany()->get()->pluck('name','id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $serviceCategories = $this->all();
        return formatOptionsForSelect($serviceCategories , 'getId' , 'getName');
    }
     public function oneFormattedForSelect($model)
    {
        $serviceCategories = ServiceCategory::where('id',$model->getServiceCategoryId())->get();
        return formatOptionsForSelect($serviceCategories , 'getId' , 'getName');
    }
    
     public function allCurrentServiceCategoryServiceCategories():array
    {
        return ServiceCategory::onlyCurrentCompany()->get()->pluck('name','id')->toArray();
    }
     public function getAllExcept($id):?Collection
    {
        return ServiceCategory::onlyCurrentCompany()->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return ServiceCategory::onlyCurrentCompany()->query();

    }
    public function Random():Builder
    {
        return ServiceCategory::onlyCurrentCompany()->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return ServiceCategory::onlyCurrentCompany()->find($id);
    }

    public function getLatest($column = 'id'):?ServiceCategory
    {
        return ServiceCategory::onlyCurrentCompany()->latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        return ServiceCategory::create([
        'revenue_business_line_id'=>$request->get('revenue_business_line_id'),
        'name'=>$request->get('service_category_name')
        ]);
    }




    public function update( IBaseModel $serviceCategory , Request $request ):void
    {
        $serviceCategory->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(ServiceCategory $serviceCategory){
            $serviceCategory['name_'.App()->getLocale()] = $serviceCategory->getName();
            $serviceCategory->companyName = $serviceCategory->getCompanyName();
            $serviceCategory->creator_name = $serviceCategory->getCreatorName();
            $serviceCategory->created_at_formatted = formatDateFromString($serviceCategory->created_at);

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> ServiceCategory::onlyCurrentCompany()->count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return ServiceCategory::onlyCurrentCompany()->when($request->filled('search_input') , function(Builder $builder) use ($request){

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
            ->get()->each(function($serviceCategory){

                $serviceCategory->name_en = $serviceCategory->getName();
                $serviceCategory->company_id = $serviceCategory->getCompanyId();
                $serviceCategory->join_at = formatDateFromString($serviceCategory->join_at);

            });


    }






}
