<?php

namespace App\Models\Repositories;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Repositories\IBaseRepository;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CustomerRepository implements IBaseRepository 
{
    public function all():Collection
    {
        return Customer::onlyCurrentCompany()->get();
    }

    public function allFormatted():array
    {
        return Customer::onlyCurrentCompany()->get()->pluck('name','id')->toArray();
    }
    public function allFormattedForSelect()
    {
        $customers = $this->all();
        return formatOptionsForSelect($customers , 'getId' , 'getNameAndType');
    }
    
     public function oneFormattedForSelect($model)
    {
        $customers = Customer::where('id',$model->getCustomerId())->get();
        return formatOptionsForSelect($customers , 'getId' , 'getNameAndType');
    }
    
  
     public function getAllExcept($id):?Collection
    {
        return Customer::onlyCurrentCompany()->where('id','!=',$id)->get();
    }

    public function query():Builder
    {
        return Customer::onlyCurrentCompany()->query();

    }
    public function Random():Builder
    {
        return Customer::onlyCurrentCompany()->inRandomOrder();
    }

    public function find(?int $id):IBaseModel
    {
        return Customer::onlyCurrentCompany()->find($id);
    }

    public function getLatest($column = 'id'):?Customer
    {
        return Customer::onlyCurrentCompany()->latest($column)->first();

    }
     public function store(Request $request ):IBaseModel
    {
        $customer = Customer::create([
            'name'=>$request->get('customer_name'),
            'type'=>$request->get('customer_type'),
            'company_id'=>\getCurrentCompanyId(),
            'creator_id'=>Auth()->user()->id 
        ]);
        
        return $customer ;
    }

    public function createRecord(Request $request  , $serviceItemName = null  ):Customer
    {
        $customerId = $request->get('revenue_business_line_id') ;
        $serviceCategoryId = $request->get('service_category_id') ;
        $serviceItemId = $request->get('service_item_id') ;
        
        return Customer::create([
                'revenue_business_line_id'=> $customerId =  is_numeric($customerId) ? $customerId 
                : App(CustomerRepository::class)->store($request)->id  ,
                'service_category_id'=> $serviceCategoryId =  is_numeric($serviceCategoryId) ? $serviceCategoryId 
                : App(ServiceCategoryRepository::class)->store($request->replace(array_merge($request->all() , ['revenue_business_line_id'=>$customerId])))->id,
                'service_item_id'=> is_numeric($serviceItemId) ? $serviceItemId 
                : App(ServiceItemRepository::class)->store($request->replace(array_merge($request->all() , ['revenue_business_line_id'=>$customerId , 'service_category_id'=>$serviceCategoryId , 'service_item_name'=>$serviceItemName ])))->id              
            ]);
    }



    public function update( IBaseModel $customer , Request $request ):void
    {
        $customer->update($request->except('_token'));
    }

    public function paginate(Request $request):array
    {

        $filterData = $this->commonScope($request);

        $allFilterDataCounter = $filterData->count();

        $datePerPage = $filterData->skip(Request('start'))->take(Request('length'))->get()->each(function(Customer $customer , $index){
            $customer->customerName = $customer->getName();
            $customer->creator_name = $customer->getCreatorName();
            $customer->created_at_formatted = formatDateFromString($customer->created_at);
            $customer->updated_at_formatted = formatDateFromString($customer->updated_at);
            $customer->serviceCategories = $customer->serviceCategories->load('serviceItems'); 
            $customer->order = $index+1 ;

        }) ;
        return [
            'data'=>$datePerPage ,
            "draw"=> (int)Request('draw'),
            "recordsTotal"=> Customer::onlyCurrentCompany()->count(),
            "recordsFiltered"=>$allFilterDataCounter,
        ] ;

    }

    public function commonScope(Request $request):builder
    {
        return Customer::onlyCurrentCompany()->when($request->filled('search_input') , function(Builder $builder) use ($request){

            $builder
            ->where(function(Builder $builder) use ($request){
                $builder->when($request->filled('search_input'),function(Builder $builder) use ($request){
                    $keyword = "%".$request->get('search_input')."%";
                    $builder->where('name' , 'like' , $keyword)
                    ->orWhereHas('creator',function(Builder $builder) use($keyword) {
                        $builder->where('name','like',$keyword);
                    })->orWhereHas('company',function(Builder $builder) use($keyword) {
                        $builder->where('name','like',$keyword);
                    })
                    ;
                    
                })
                ;
                
            });
        })
        ->when($request->filled('revenue_business_line_id') && $request->get('revenue_business_line_id') != 'All' , function(Builder $builder) use ($request){
                    // $builder->whereHas('company',function(Builder $builder) use ($request){
                        $builder->where('id',$request->get('revenue_business_line_id'));
                    // });
                })

                  ->when($request->filled('service_category_id') && $request->get('service_category_id') != 'All' , function(Builder $builder) use ($request){
                    $builder->whereHas('serviceCategories',function(Builder $builder) use ($request){
                        $builder->where('id',$request->get('service_category_id'));
                    });
                })
                ->when($request->filled('service_item_id') && $request->get('service_item_id') != 'All' , function(Builder $builder) use ($request){
                    $builder->whereHas('serviceItems',function(Builder $builder) use ($request){
                        $builder->where('service_items.id',$request->get('service_item_id'));
                    });
                })
        
        ->orderBy(getDefaultOrderBy()['column'],getDefaultOrderBy()['direction']) ;

    }

    public function export(Request $request):Collection
    {
        return $this->commonScope(
            $request->replace(
                array_merge($request->all(),[
                    'format'=>$request->get('format'),
                ]  )
            ))
            ->select(['id','name','company_id','created_at as join_at'])
            ->get()->each(function($customer){

                $customer->name = $customer->getName();
                // $customer->company_id = $customer->getCompanyId();
                // $customer->join_at = formatDateFromString($customer->join_at);

            });


    }






}
