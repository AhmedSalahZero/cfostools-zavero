<?php
namespace App\Models\Traits\Accessors ;
trait SharingLinkAccessor
{
    public function getId():int
    {
        return $this->id ; 
    }
    public function getName():string 
    {
        return $this->user_name ?: __('N/A');
    }
    public function getLink():string 
    {
        return $this->link;
    }
    public function getSharableTypeName():string {
        return getLastWordInString($this->shareable_type,'\\');
    }
    public function isActive():bool 
    {
        return $this->is_active ;
    }
    public function getCompanyId():int
    {
        return $this->company->id ?? 0; 
    }
    public function getCompanyName():string
    {
        return $this->company->getName() ;
    }
    public function getCreatorName():string
    {
        return $this->creator->name ?? __('N/A');
    }
}