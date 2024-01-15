<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blueprint::macro('sharedPricingCalculatorsColumns', function () {
            $this->string('name')->nullable();
            $this->string('date');
          
            $this->unsignedBigInteger('country_id')->nullable();
            // $this->foreign('country_id')->references('id')->on('countries')->cascadeOnDelete()->cascadeOnUpdate();
             $this->unsignedBigInteger('state_id')->nullable();
            // $this->foreign('state_id')->references('id')->on('states')->cascadeOnDelete()->cascadeOnUpdate();
            $this->unsignedBigInteger('currency_id')->nullable();
            // $this->foreign('currency_id')->references('id')->on('currencies')->nullOnDelete()->nullOnUpdate();
            $this->double('price_sensitivity')->default(0);
            $this->boolean('use_freelancer')->default(1);
            
            $this->string('total_recommend_price_without_vat')->default(0);
            $this->string('total_recommend_price_with_vat')->default(0);
            $this->string('price_per_day_without_vat')->default(0);
            $this->string('price_per_day_with_vat')->default(0);
            $this->string('total_net_profit_after_taxes')->default(0);
            $this->string('net_profit_after_taxes_per_day')->default(0);
            $this->string('total_sensitive_price_without_vat')->default(0);
            $this->string('total_sensitive_price_with_vat')->default(0);
            $this->string('sensitive_price_per_day_without_vat')->default(0);
            $this->string('sensitive_price_per_day_with_vat')->default(0);


            
            $this->string('sensitive_total_net_profit_after_taxes')->default(0);
            $this->string('sensitive_net_profit_after_taxes_per_day')->default(0);
            $this->string('sensitive_net_profit_after_taxes_percentage')->default(0);
            
            
            
        });
           Blueprint::macro('sharedPercentageWithCostColumns' , function(){
            $this->float('percentage_of_price')->default(0);
            $this->double('working_days')->default(0);
            $this->double('cost_per_day')->default(0);
            $this->double('total_cost')->default(0);
        });
        
        Blueprint::macro('sharedCostColumns' , function(){
            $this->double('working_days')->default(0);
            $this->double('cost_per_day')->default(0);
            $this->double('total_cost')->default(0);
        });

         Blueprint::macro('sharedPercentageColumns' , function(){
            $this->float('percentage_of_price')->default(0);
            $this->double('cost_per_unit')->default(0);
            $this->double('unit_cost')->default(0);
            $this->double('total_cost');
            
        });
        
        
        Blueprint::macro('sharedColumns' , function(){
            $this->unsignedBigInteger('company_id');
            $this->foreign('company_id','company_id_'.$this->table)->references('id')->on('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $this->unsignedBigInteger('creator_id')->nullable();
            $this->foreign('creator_id','creator_id_'.$this->table)->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $this->timestamps();
            
        });
        // 
    }
}
