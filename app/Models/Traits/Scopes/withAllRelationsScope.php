<?php
namespace App\Models\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait withAllRelationsScope
{
        public function scopeWithAllRelations(Builder $builder , int $companyId = null) 
        {
            $builder->with($this->getAllRelationsNames());
        }
        
} 