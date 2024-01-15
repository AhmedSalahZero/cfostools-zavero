<?php

namespace App\Http\Controllers;

use App\Models\Repositories\SharingLinkRepository;
use Illuminate\Http\Request;

class ViewShareableLinkController extends Controller
{
    private SharingLinkRepository $sharingLinkRepository ;
    
   public function __construct(SharingLinkRepository $sharingLinkRepository)
   {
       $this->sharingLinkRepository = $sharingLinkRepository ;
   }
    public function __invoke(Request $request   , $modelName , $uniqueStr)
    {
        $sharingLink = $this->sharingLinkRepository->findBy('identifier',$uniqueStr);
        $sharingLink->increaseNumberOfViews();
        $shareAble = $sharingLink->shareable;
        $viewName = $shareAble->getCrudViewName();
        return view($viewName , array_merge( get_class($shareAble)::getShareableEditViewVars($shareAble) , [
            'type'=>'edit',
            'model'=>$shareAble,
            'disabled'=>true 
        ]));
        
    }
}
