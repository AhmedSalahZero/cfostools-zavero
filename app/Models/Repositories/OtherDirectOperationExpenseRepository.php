<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\OtherDirectOperationExpense;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OtherDirectOperationExpenseRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->get();
    }

    public function allFormatted():array
    {
        return OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->get()->pluck('name','name')->toArray();
    }
    public static function allFormattedForSelect()
    {
        $otherDirectOperationExpenses = $this->all();
        return formatOptionsForSelect($otherDirectOperationExpenses , 'getExpenseName' , 'getExpenseName');
    }
 
     public function getAllExcept($id):?Collection
    {
        return OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return OtherDirectOperationExpense::query();

    }
    public function Random():Builder
    {
        return OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->find($id);
    }

    public function getLatest($column = 'id'):?OtherDirectOperationExpense
    {
        return OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        
        return OtherDirectOperationExpense::create([
            'name'=>$request->get('service_item_name'),
            // 'service_category_id'=>$request->get('service_category_id'),
            // 'revenue_business_line_id'=>$request->get('revenue_business_line_id')
        ]);
    }




    public function update( IBaseModel $otherDirectOperationExpense , Request $request ):void
    {
        $otherDirectOperationExpense->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(OtherDirectOperationExpense $otherDirectOperationExpense){
            $otherDirectOperationExpense['name'] = $otherDirectOperationExpense->getName();
            $otherDirectOperationExpense->companyName = $otherDirectOperationExpense->getCompanyName();
            $otherDirectOperationExpense->creator_name = $otherDirectOperationExpense->getCreatorName();
            $otherDirectOperationExpense->created_at_formatted = formatDateFromString($otherDirectOperationExpense->created_at);

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return OtherDirectOperationExpense::where('company_id',getCurrentCompanyId())->when($request->filled('search_input') , function(Builder $builder) use ($request){

            $builder
            ->where(function(Builder $builder) use ($request){
                $builder->when($request->filled('search_input'),function(Builder $builder) use ($request){
                    $keyword = "%".$request->get('search_input')."%";
                    $builder->where('name' , 'like' , $keyword)
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
            ->select(['id','name','company_id','created_at as join_at'])
            ->get()->each(function($otherDirectOperationExpense){

                $otherDirectOperationExpense->name_en = $otherDirectOperationExpense->getName();
                $otherDirectOperationExpense->company_id = $otherDirectOperationExpense->getCompanyId();
                $otherDirectOperationExpense->join_at = formatDateFromString($otherDirectOperationExpense->join_at);

            });


    }






}
