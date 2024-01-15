<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectManpowerExpenseQuickPricingCalculatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_manpower_expense_quick_pricing_calculator', function (Blueprint $table) {
            $table->morphs('directManpowerExpenseAble','directManpowerMorph');
            $table->unsignedBigInteger('service_item_id')->nullable();
            $table->foreign('service_item_id','service_item_mex')->references('id')->on('service_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('direct_manpower_expense_id');
            $table->foreign('direct_manpower_expense_id','dmp_id')->references('id')->on('direct_manpower_expenses')
            ->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id','pos_direct_id')->references('id')->on('positions')
            ->cascadeOnDelete()->cascadeOnUpdate()
            ;
            
            $table->sharedCostColumns();
            $table->sharedColumns();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direct_manpower_expense_quick_pricing_calculator');
    }
}
