<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CompanyRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return Company::get();
    }

    public function allFormatted():array
    {
        $companies = Company::get();
        return formatOptionsForSelect($companies , 'getId' , 'getName');
    }
     public function allCurrentCompanyCompanies():array
    {
        return Company::get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
     public function getAllExcept($id):?Collection
    {
        return Company::where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return Company::query();

    }
    public function Random():Builder
    {
        return Company::inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return Company::find($id);
    }

    public function getLatest($column = 'id'):?Company
    {
        return Company::latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        return Company::create(array_merge($request->except('_token') ));
    }



    // public function detach(IHaveCompaniesModel $iHaveCompaniesModel):void
    // {
    //     $iHaveCompaniesModel->companies()->detach();
    // }
    public function update( IBaseModel $company , Request $request ):void
    {
        $company->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(Company $company){
            $company->companyName = $company->getCompanyName();
            $company->address = $company->getAddress();
            $company->phone = $company->getPhone();
             $company->creator_name = $company->getCreatorName();

        }) ;

        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> Company::count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return Company::when($request->filled('search_input') , function(Builder $builder) use ($request){

            $builder->where(function(Builder $builder) use ($request){
                $builder->where('name_'.App()->getLocale(),'like',"%$request->search_input%")
                ->orWhereHas('company' , function(Builder $builder) use ($request){
                    $builder->where('name_'.App()->getLocale()  , 'like' , "%$request->search_input%") ;
                });
            });
        })
        ->when($request->filled('company_id') , function(Builder $builder) use($request){
            $builder->whereHas('company' , function(Builder $builder) use ($request){
                $builder->where('id' , $request->get('company_id')) ;
            }) ;
        })->orderBy('id','desc') ;

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
            ->select(['id','name_en','company_id','created_at as entered_at'])
            ->get()->each(function($company){

                $company->name_en = $company->getName();
                $company->company_id = $company->getCompanyName();
                $company->entered_at = formatDateFromString($company->entered_at);

            });


    }






}
