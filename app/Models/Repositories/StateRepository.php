<?php

namespace App\Models\Repositories;

use App\Interfaces\Excel\Exportable;
use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IHaveStatesModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\State;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StateRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return State::get();
    }

    public function allFormatted():array
    {
        return State::onlyCompanyOwnership('states')->get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
     public function allCurrentCompanyStates():array
    {
        return State::onlyCurrentCompany()->get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
     public function getAllExcept($id):?Collection
    {
        return State::onlyCurrentCompany()->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return State::query();
    }
    public function Random():Builder
    {
        return State::inRandomOrder();
    }

    public function find($id):?State
    {
        return State::find($id);
    }

    public function getLatest($column = 'id'):?State
    {
        return State::latest($column)->first();

    }
    public function store(Request $request ):State
    {
        return State::create(array_merge($request->except('_token') ));
    }
    
    // public function detach(IHaveStatesModel $iHaveStatesModel):void
    // {
    //     $iHaveStatesModel->states()->detach();
    // }
    public function update( IBaseModel $state , Request $request ):void
    {
        $state->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(State $state){
            $state->companyName = $state->getCompanyName();
            $state->address = $state->getAddress();
            $state->phone = $state->getPhone();
             $state->creator_name = $state->getCreatorName();

        }) ;

        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> State::count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return State::when($request->filled('search_input') , function(Builder $builder) use ($request){

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


    // public function assignStatesTo(IHaveStatesModel $iHaveStatesModel, Request $request):void
    // {

    //         $iHaveStatesModel->states()->attach($request->get('state_ids')  ?: (Auth()->check() ? Auth()->user()->getMainStateId():1)  );
    // }


    // public function updateStatesTo(IHaveStatesModel $iHaveStatesModel , Request $request):void
    // {
    //     $iHaveStatesModel->states()->sync($request->get('state_ids'));
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
            ->get()->each(function($state){

                $state->name_en = $state->getName();
                $state->company_id = $state->getCompanyName();
                $state->entered_at = formatDateFromString($state->entered_at);

            });


    }






}
