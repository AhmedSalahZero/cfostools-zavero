<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancerExpenseQuickPricingCalculatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancer_expense_quick_pricing_calculator', function (Blueprint $table) {
            $table->morphs('freelancerExpenseAble','freelancerMorph');
            // $table->unsignedBigInteger('quick_pricing_calculator_id');
            // $table->foreign('quick_pricing_calculator_id','qpc_id')->references('id')->on('quick_pricing_calculators');
            $table->unsignedBigInteger('freelancer_expense_id');
            $table->foreign('freelancer_expense_id','freelancer_p_id')->references('id')->on('freelancer_expenses')
            ->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->unsignedBigInteger('position_id');
            $table->foreign('position_id','pos_freelancer_id')->references('id')->on('positions');

            $table->sharedPercentageWithCostColumns();
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
