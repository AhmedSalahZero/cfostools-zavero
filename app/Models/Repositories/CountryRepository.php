<?php

namespace App\Models\Repositories;

use App\Interfaces\Excel\Exportable;
use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IHaveCountriesModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CountryRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return Country::onlyUserOwnership('countries')->get();
    }

    public function allFormatted():array
    {
        return Country::onlyCompanyOwnership('countries')->get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
     public function allCurrentCompanyCountries():array
    {
        return Country::onlyCompanyOwnership('countries')->onlyCurrentCompany()->get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
     public function getAllExcept($id):?Collection
    {
        return Country::onlyCompanyOwnership('countries')->onlyCurrentCompany()->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return Country::onlyUserOwnership('countries')->query();

    }
    public function Random():Builder
    {
        return Country::onlyUserOwnership('countries')->inRandomOrder();
    }

    public function find($id):?Country
    {
        return Country::find($id);
    }

    public function getLatest($column = 'id'):?Country
    {
        return Country::latest($column)->first();

    }
    public function store(Request $request ):Country
    {
        return Country::create(array_merge($request->except('_token') ));
    }



    // public function detach(IHaveCountriesModel $iHaveCountriesModel):void
    // {
    //     $iHaveCountriesModel->countries()->detach();
    // }
    public function update( IBaseModel $country , Request $request ):void
    {
        $country->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(Country $country){
            $country->companyName = $country->getCompanyName();
            $country->address = $country->getAddress();
            $country->phone = $country->getPhone();
             $country->creator_name = $country->getCreatorName();

        }) ;

        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> Country::count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return Country::onlyUserOwnership('countries')->when($request->filled('search_input') , function(Builder $builder) use ($request){

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


    // public function assignCountriesTo(IHaveCountriesModel $iHaveCountriesModel, Request $request):void
    // {

    //         $iHaveCountriesModel->countries()->attach($request->get('country_ids')  ?: (Auth()->check() ? Auth()->user()->getMainCountryId():1)  );
    // }


    // public function updateCountriesTo(IHaveCountriesModel $iHaveCountriesModel , Request $request):void
    // {
    //     $iHaveCountriesModel->countries()->sync($request->get('country_ids'));
    // }


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
            ->get()->each(function($country){

                $country->name_en = $country->getName();
                $country->company_id = $country->getCompanyName();
                $country->entered_at = formatDateFromString($country->entered_at);

            });


    }






}
