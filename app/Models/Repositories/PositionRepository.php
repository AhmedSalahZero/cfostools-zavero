<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\Position;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PositionRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return Position::where('company_id',getCurrentCompanyId())->get();
    }

    public function allFormatted():array
    {
        return Position::where('company_id',getCurrentCompanyId())->get()->pluck('name','id')->toArray();
    }
    public function allFormattedForSelect($type)
    {
        $positions = $this->all();
		$positions = $positions->where('position_type',$type);
        return formatOptionsForSelect($positions , 'getId' , 'getName');
    }
	public function oneFormattedForSelect($model,$type)
    {
        $positions = Position::where('company_id',$model->company_id)->where('position_type',$type)->get();
        return formatOptionsForSelect($positions , 'getName' , 'getName');
    }
     public function getAllExcept($id):?Collection
    {
        return Position::where('company_id',getCurrentCompanyId())->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return Position::query();

    }
    public function Random():Builder
    {
        return Position::where('company_id',getCurrentCompanyId())->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return Position::find($id);
    }

    public function getLatest($column = 'id'):?Position
    {
        return Position::where('company_id',getCurrentCompanyId())->latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        
        return Position::create([
            'name'=>$request->get('service_item_name'),
            'service_category_id'=>$request->get('service_category_id'),
			'company_id'=>getCurrentCompanyId()
            // 'revenue_business_line_id'=>$request->get('revenue_business_line_id')
        ]);
    }




    public function update( IBaseModel $position , Request $request ):void
    {
        $position->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(Position $position){
            $position['name_'.App()->getLocale()] = $position->getName();
            $position->companyName = $position->getCompanyName();
            $position->creator_name = $position->getCreatorName();
            $position->created_at_formatted = formatDateFromString($position->created_at);

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> Position::count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return Position::where('company_id',getCurrentCompanyId())->when($request->filled('search_input') , function(Builder $builder) use ($request){

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
            ->get()->each(function($position){

                $position->name_en = $position->getName();
                $position->company_id = $position->getCompanyId();
                $position->join_at = formatDateFromString($position->join_at);

            });


    }






}
