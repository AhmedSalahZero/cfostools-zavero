<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralExpenseQuickPricingCalculatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_expense_quick_pricing_calculator', function (Blueprint $table) {
            $table->morphs('generalExpenseAble','generalMorph');
            // $table->unsignedBigInteger('quick_pricing_calculator_id');
            // $table->foreign('quick_pricing_calculator_id','qpc_id')->references('id')->on('quick_pricing_calculators');
            $table->unsignedBigInteger('general_expense_id');
            $table->foreign('general_expense_id','gndm_p_id')->references('id')->on('general_expenses')
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
        Schema::dropIfExists('general_expense_quick_pricing_calculator');
    }
}
