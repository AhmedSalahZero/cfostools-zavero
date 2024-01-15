<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model implements IBaseModel
{
    use HasFactory;

     public function getRouteKeyName()
    {
        return 'countries.id' ;
    }

    
    public function getName(): string
    {
        return $this['name_'.App()->getLocale()];
    }
    public function getUpdateRoute():string
    {
       return 'test';
    //    return route('admin.customers.update' , $this->id);

    }

    public static function getStoreRoute():string
    {
       return 'test';
    //    return route('admin.customers.store' , );

    }

    public static function getViewVariables(): array
    {
        $customerGroupsRepo = App(CustomerGroupRepository::class);

        return [
            // 'customerGroups'=>$customerGroupsRepo->allFormatted() ,
            // 'modelName'=>'Customer' ,
            // 'exportRoute'=>route('admin.customers.export'),
            // 'importRoute'=>route('admin.customers.import'),
            // 'downloadImportFileRoute'=>route('admin.customers.download.import.file'),
            // 'companies'=>App(CompanyRepository::class)->allFormatted(),
        ];
    }
    
    public function states():HasMany{
        return $this->hasMany(State::class , 'country_id' , 'id') ; 
    } // 
}
