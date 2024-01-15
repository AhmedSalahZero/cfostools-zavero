<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CurrencyRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return Currency::get();
    }

    public function allFormatted():array
    {
        return Currency::get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $currencys = $this->all();
        return formatOptionsForSelect($currencys , 'getId' , 'getName');
    }
     public function oneFormattedForSelect($model)
    {
        $currencys = Currency::where('id',$model->getPositionId())->get();
        return formatOptionsForSelect($currencys , 'getId' , 'getName');
    }
    
     public function allCurrentCurrencyCurrencies():array
    {
        return Currency::get()->pluck('name_'.App()->getLocale(),'id')->toArray();
    }
     public function getAllExcept($id):?Collection
    {
        return Currency::where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return Currency::query();

    }
    public function Random():Builder
    {
        return Currency::inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return Currency::find($id);
    }

    public function getLatest($column = 'id'):?Currency
    {
        return Currency::latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        
        return Currency::create([
            'name'=>$request->get('service_item_name'),
            'service_category_id'=>$request->get('service_category_id'),
            // 'revenue_business_line_id'=>$request->get('revenue_business_line_id')
        ]);
    }




    public function update( IBaseModel $currency , Request $request ):void
    {
        $currency->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(Currency $currency){
            $currency['name_'.App()->getLocale()] = $currency->getName();
            $currency->companyName = $currency->getCompanyName();
            $currency->creator_name = $currency->getCreatorName();
            $currency->created_at_formatted = formatDateFromString($currency->created_at);

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> Currency::count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return Currency::when($request->filled('search_input') , function(Builder $builder) use ($request){

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
            ->get()->each(function($currency){

                $currency->name_en = $currency->getName();
                $currency->company_id = $currency->getCompanyId();
                $currency->join_at = formatDateFromString($currency->join_at);

            });


    }






}
