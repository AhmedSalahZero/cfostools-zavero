<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\SharingLink;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class SharingLinkRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return SharingLink::get();
    }

    public function allFormatted():array
    {
        return SharingLink::get()->pluck('user_name','id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $sharingLinks = $this->all();
        return formatOptionsForSelect($sharingLinks , 'getId' , 'getName');
    }
     public function allCurrentSharingLinkSharingLinks():array
    {
        return SharingLink::get()->pluck('name','id')->toArray();
    }
     public function getAllExcept($id):?Collection
    {
        return SharingLink::where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return SharingLink::query();

    }
    public function Random():Builder
    {
        return SharingLink::inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return SharingLink::find($id);
    }

    public function findBy($column,$value):IBaseModel
    {
        return SharingLink::where($column , $value)->firstOrFail();
    }
 
    public function getLatest($column = 'id'):?SharingLink
    {
        return SharingLink::latest($column)->first();

    }
    public function store(Request $request ):IBaseModel
    {
        $link = generateShareableLink(camel2dashed($request->get('shareable_type')));
        return SharingLink::create([
            'user_name'=>$request->get('user_name'),
            'creator_id'=>Auth()->user()->id ,
            'shareable_type'=>\getModelNamespace() . $request->get('shareable_type'),
            'shareable_id'=>$request->get('shareable_id'),
            'is_active'=>true ,
            'link'=>$link,
            'identifier'=>getLastWordInString($link , '/')
        ]);
    }




    public function update( IBaseModel $sharingLink , Request $request ):void
    {
        $sharingLink->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();


        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(SharingLink $sharingLink){
            $sharingLink->user_name = $sharingLink->getName();
            $sharingLink->link = $sharingLink->getLink();
            $sharingLink->shareableTypeName = $sharingLink->getSharableTypeName();
            $sharingLink->creator_name = $sharingLink->getCreatorName();
            $sharingLink->created_at_formatted = formatDateFromString($sharingLink->created_at);

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> SharingLink::count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return SharingLink::when($request->filled('search_input') , function(Builder $builder) use ($request){

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
            ->get()->each(function($sharingLink){

                $sharingLink->name_en = $sharingLink->getName();
                $sharingLink->company_id = $sharingLink->getCompanyId();
                $sharingLink->join_at = formatDateFromString($sharingLink->join_at);

            });


    }






}
