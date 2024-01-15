<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesAndMarketingQuickPricingCalculatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_and_marketing_quick_pricing_calculator', function (Blueprint $table) {
            $table->morphs('salesAndMarketingExpenseAble','salesAndMarketingMorph');
            // $table->unsignedBigInteger('quick_pricing_calculator_id');
            // $table->foreign('quick_pricing_calculator_id','qpc_id')->references('id')->on('quick_pricing_calculators');
            $table->unsignedBigInteger('sales_and_marketing_expense_id');
            $table->foreign('sales_and_marketing_expense_id','sandm_p_id')->references('id')->on('sales_and_marketing_expenses')
            ->cascadeOnDelete()->cascadeOnUpdate();
            
            // $table->unsignedBigInteger('position_id');
            // $table->foreign('position_id','pos_freelancer_id')->references('id')->on('positions');

            $table->sharedPercentageColumns();
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
        Schema::dropIfExists('sales_and_marketing_quick_pricing_calculator');
    }
}
