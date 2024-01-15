<?php
namespace App\Models\Traits\Scopes\Globals;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class StateCountryScope implements Scope
{
    public function apply(Builder $builder , Model $model)
    {
        $builder->leftJoin('states' , function($leftOuterJoin) use ($model){
            $leftOuterJoin->on($model->getTable().'.state_id' , 'states.id'); // $model->getTable()  returns [purchases , sales ... etc]
        })->addSelect(['country_id'=>DB::table('countries')->select('countries.id')->whereColumn('countries.id','states.country_id')]);
    }

} 