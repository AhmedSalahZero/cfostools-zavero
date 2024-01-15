<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IExportable;
use App\Interfaces\Models\IHaveView;
use App\Models\Traits\Accessors\SharingLinkAccessor;
use App\Models\Traits\Mutators\SharingLinkMutator;
use App\Models\Traits\Relations\SharingLinkRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharingLink extends Model implements IBaseModel , IExportable , IHaveView
{
    use HasFactory , SharingLinkAccessor  , SharingLinkRelation ,SharingLinkMutator ;
    
    protected $guarded = [
        'id'
    ];

    public static function getPageTitle():string 
    {
        return __('Sharable Links');
    }
    
    public static function exportViewName(): string {
        return __('Shareable Links');
    }

    public static function getFileName(): string {
        return __('Shareable Links');
    }

    
    public static function getViewVars():array 
    {
        $currentCompanyId =  getCurrentCompanyId();
        
        return [
            'getDataRoute'=>route('admin.get.sharing.links' , ['company'=>$currentCompanyId]) ,
            'modelName'=>'SharingLink',
            'exportRoute'=>route('admin.export.sharing.link' , $currentCompanyId),
            'createRoute'=>route('sharing-links.create',$currentCompanyId),
            'storeRoute'=>route('sharing-links.store',$currentCompanyId),
            'hasChildRows'=>false,
            'pageTitle'=>SharingLink::getPageTitle(),
            'type'=>'create'
        ];
        
    }
    
    
    
}
