<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Models\Traits\Relations\Commons\StateRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model implements IBaseModel 
{
    public function getRouteKeyName()
    {
        return 'states.id' ;
    }
    
    use HasFactory , StateRelations;

    public function getName(): string
    {
        return $this->name[App()->getLocale()];
    }

    public static function getStoreRoute():string
    {
       return 'test';
    //    return route('admin.customers.store' , );

    }

    public static function getViewVariables(): array
    {
        // $customerGroupsRepo = App(CustomerGroupRepository::class);

        return [
            // 'customerGroups'=>$customerGroupsRepo->allFormatted() ,
            // 'modelName'=>'Customer' ,
            // 'exportRoute'=>route('admin.customers.export'),
            // 'importRoute'=>route('admin.customers.import'),
            // 'downloadImportFileRoute'=>route('admin.customers.download.import.file'),
            // 'companies'=>App(CompanyRepository::class)->allFormatted(),
        ];
    }
}
