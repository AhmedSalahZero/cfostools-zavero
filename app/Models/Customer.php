<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Models\Repositories\CustomerRepository;
use App\Models\Traits\Accessors\CustomerAccessor;
use App\Models\Traits\Mutators\CustomerMutator;
use App\Models\Traits\Relations\CustomerRelation;
use App\Models\Traits\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model  implements IBaseModel
{
    use HasFactory , CustomerRelation ,CustomerAccessor  , CustomerMutator , CompanyScope;

    protected $guarded = [
        'id'
    ];

    const types = [
        'customer','lead'
    ];

    public static function getCrudFormName():string 
    {
        return 'admin.customers.form';
    }
    public static function getPageTitle()
    {
        return __('Customers And Leads');
    }
     public static function getViewVars():array 
    {
        // dd($companyId);
        $currentCompanyId =  getCurrentCompanyId();
        
        return [
            // 'getDataRoute'=>route('admin.get.quick.pricing.calculator' , ['company'=>$currentCompanyId]) ,
            'modelName'=>'Customer',
            // 'exportRoute'=>route('admin.export.quick.pricing.calculator' , $currentCompanyId),
            // 'createRoute'=>route('admin.create.quick.pricing.calculator',$currentCompanyId),
            'storeRoute'=>route('admin.store.customers',$currentCompanyId),
            'pageTitle'=>static::getPageTitle(),
            'customerTypes'=>static::types,
            'type'=>'create'
        ];
        
    }

    
}
