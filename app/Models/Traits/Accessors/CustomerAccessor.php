<?php
namespace App\Models\Traits\Accessors ;
trait CustomerAccessor
{
    public function getId():int
    {
        return $this->id ; 
    }
    public function getName():string 
    {
        return $this->name;
    }
    public function getNameAndType():string 
    {
        return $this->name .' ( ' . $this->type . ' )'; 
     }
     
    public function getType():string 
    {
        return $this->type ;
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