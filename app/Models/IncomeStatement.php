<?php

namespace App\Models;

use App\Interfaces\Models\IBaseModel;
use App\Interfaces\Models\IExportable;
use App\Interfaces\Models\IHaveAllRelations;
use App\Interfaces\Models\IShareable;
use App\Models\Expenses;
use App\Models\Traits\Accessors\IncomeStatementAccessor;
use App\Models\Traits\Mutators\IncomeStatementMutator;
// use App\Models\Traits\Scopes\Globals\StateCountryScope;
use App\Models\Traits\Relations\IncomeStatementRelation;
use App\Models\Traits\Scopes\CompanyScope;
use App\Models\Traits\Scopes\withAllRelationsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  IncomeStatement extends Model implements IBaseModel , IHaveAllRelations , IExportable , IShareable
{
    use HasFactory , IncomeStatementAccessor,IncomeStatementMutator , IncomeStatementRelation , CompanyScope , withAllRelationsScope ;
         
        protected $guarded = [
            'id'
        ];
       public static function getShareableEditViewVars($model):array 
    {
        
        return [
            'pageTitle'=>IncomeStatement::getPageTitle(),
            
        ];   
    }
    public function getRouteKeyName()
    {
        return 'income_statements.id' ;
    }
    public static function exportViewName():string {
        return __('Income Statement'); 
    }
     public static function getFileName():string 
    {
        return __('Income Statement');
    }

    protected static function booted()
    {
        // static::addGlobalScope(new StateCountryScope);
    }

    public static function getCrudViewName():string 
    {
        return 'admin.income-statement.create';
    }
    
    public static function getViewVars():array 
    {
        $currentCompanyId =  getCurrentCompanyId();
        
        return [
            'getDataRoute'=>route('admin.get.income.statement' , ['company'=>$currentCompanyId]) ,
            'modelName'=>'IncomeStatement',
            'exportRoute'=>route('admin.export.income.statement' , $currentCompanyId),
            'createRoute'=>route('admin.create.income.statement',$currentCompanyId),
            'storeRoute'=>route('admin.store.income.statement',$currentCompanyId),
            'hasChildRows'=>false ,
            'pageTitle'=>IncomeStatement::getPageTitle(),
            'redirectAfterSubmitRoute'=>route('admin.view.income.statement',$currentCompanyId),
            'type'=>'create',
            'redirectAfterSubmitRoute'=>route('admin.view.income.statement',['company'=>getCurrentCompanyId()]),
            'durationTypes'=>[
                [
                    'value'=>'monthly',
                    'title'=>__('Monthly')
                ],
                [
                    'value'=>'annually',
                    'title'=>__('Annually')
                ],
            ]
        ];
        
    }
    public static function getReportViewVars(array $options = []):array 
    {
        $currentCompanyId =  getCurrentCompanyId();
        
        return [
            'getDataRoute'=>route('admin.get.income.statement.report' , ['company'=>$currentCompanyId,'incomeStatement'=>$options['income_statement_id']]) ,
            'modelName'=>'IncomeStatementReport',
            'exportRoute'=>route('admin.export.income.statement.report' , $currentCompanyId),
            'createRoute'=>route('admin.create.income.statement.report',[
                'company'=>$currentCompanyId,
                'incomeStatement'=>$options['income_statement_id'] 
            ]),
            'storeRoute'=>route('admin.store.income.statement.report',$currentCompanyId),
            'hasChildRows'=>false ,
            'pageTitle'=>__('Income Statement Report'),
            'redirectAfterSubmitRoute'=>route('admin.view.income.statement',$currentCompanyId),
            'type'=>'create',
            'incomeStatement'=>$options['incomeStatement'],
            'interval'=>[
                [
                    'value'=>'monthly',
                    'title'=>__('Monthly')
                ],[
                    'value'=>'quarterly',
                    'title'=>__('Quarterly')
                ],[
                    'value'=>'semi-annually',
                    'title'=>__('Semi-annually')
                ],
                [
                    'value'=>'annually',
                    'title'=>__('Annually')
                ],
            ]
        ];
        
    }
    public static function getPageTitle():string 
    {
        return __('Income Statement') ;
    }

    public function getAllRelationsNames():array 
    {
        return [
            // 'revenueBusinessLine',
            // 'serviceCategory','serviceItem','serviceNatureRelation','currency','otherVariableManpowerExpenses',
            // 'directManpowerExpenses','salesAndMarketingExpenses','otherDirectOperationExpenses','generalExpenses','freelancerExpensePositions',
            // 'directManpowerExpensePositions','freelancerExpenses','profitability'
        ];
    }
	public function generateRelationDynamically(string $relationName,$expenseType){
		
		return $this->hasMany(Expenses::class , 'model_id','id')->where('model_name','IncomeStatement')->where('relation_name',$relationName)
		->where('expense_type',$expenseType)
		;
	}    
    
}
