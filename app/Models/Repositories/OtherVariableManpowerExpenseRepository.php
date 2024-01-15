<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\OtherVariableManpowerExpense;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class OtherVariableManpowerExpenseRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return OtherVariableManpowerExpense::where('company_id',getCurrentCompanyId())->get();
    }

    public function allFormatted():array
    {
        return OtherVariableManpowerExpense::where('company_id',getCurrentCompanyId())->get()->pluck('name','name')->toArray();
    }
    public function allFormattedForSelect()
    {
        $otherVariableManpowerExpenses = $this->all();
        return formatOptionsForSelect($otherVariableManpowerExpenses , 'getExpenseName' , 'getExpenseName');
    }
 
     public function getAllExcept($id):?Collection
    {
        return OtherVariableManpowerExpense::where('company_id',getCurrentCompanyId())->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return OtherVariableManpowerExpense::query();

    }
    public function Random():Builder
    {
        return OtherVariableManpowerExpense::where('company_id',getCurrentCompanyId())->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return OtherVariableManpowerExpense::find($id);
    }

    public function getLatest($column = 'id'):?OtherVariableManpowerExpense
    {
        return OtherVariableManpowerExpense::where('company_id',getCurrentCompanyId())->latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        
        return OtherVariableManpowerExpense::create([
            'name'=>$request->get('service_item_name'),
            // 'service_category_id'=>$request->get('service_category_id'),
            // 'revenue_business_line_id'=>$request->get('revenue_business_line_id')
        ]);
    }




    public function update( IBaseModel $otherVariableManpowerExpense , Request $request ):void
    {
        $otherVariableManpowerExpense->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(OtherVariableManpowerExpense $otherVariableManpowerExpense){
            $otherVariableManpowerExpense['name'] = $otherVariableManpowerExpense->getName();
            $otherVariableManpowerExpense->companyName = $otherVariableManpowerExpense->getCompanyName();
            $otherVariableManpowerExpense->creator_name = $otherVariableManpowerExpense->getCreatorName();
            $otherVariableManpowerExpense->created_at_formatted = formatDateFromString($otherVariableManpowerExpense->created_at);

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> OtherVariableManpowerExpense::where('company_id',getCurrentCompanyId())->count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return OtherVariableManpowerExpense::where('company_id',getCurrentCompanyId())->when($request->filled('search_input') , function(Builder $builder) use ($request){

            $builder
            ->where(function(Builder $builder) use ($request){
                $builder->when($request->filled('search_input'),function(Builder $builder) use ($request){
                    $keyword = "%".$request->get('search_input')."%";
                    $builder->where('name', 'like' , $keyword)
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
            ->get()->each(function($otherVariableManpowerExpense){

                $otherVariableManpowerExpense->name = $otherVariableManpowerExpense->getName();
                $otherVariableManpowerExpense->company_id = $otherVariableManpowerExpense->getCompanyId();
                $otherVariableManpowerExpense->join_at = formatDateFromString($otherVariableManpowerExpense->join_at);

            });


    }






}
