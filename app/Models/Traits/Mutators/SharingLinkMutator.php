<?php
namespace App\Models\Traits\Mutators ;
trait SharingLinkMutator
{
    public function toggleActivation()
    {
        $this->is_active = ! $this->is_active ;
        $this->save();
    }
    public function increaseNumberOfViews()
    {
        $this->number_of_views += 1 ;
        $this->save();
        return $this ; 
    }

}