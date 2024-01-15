<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherDirectOperationExpenseQuickPricingCalculatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_direct_operation_expense_quick_pricing', function (Blueprint $table) {
            $table->morphs('OtherDirectOperationExpenseAble','odoeable');
            // $table->unsignedBigInteger('quick_pricing_calculator_id');
            // $table->foreign('quick_pricing_calculator_id','qpc_id')->references('id')->on('quick_pricing_calculators');
            $table->unsignedBigInteger('other_direct_operation_expense_id');
            $table->foreign('other_direct_operation_expense_id','odop_id')
			// ->references('id')->on('other_direct_operation_expenses')
            ->cascadeOnDelete()->cascadeOnUpdate();
            // should be service_item_id
            // $table->unsignedBigInteger('position_id');
            // $table->foreign('position_id','pos_direct_id')->references('id')->on('positions');
            
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
        Schema::dropIfExists('other_direct_operation_expense_quick_pricing_calculator');
    }
}
