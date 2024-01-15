<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherVariableManpowerExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_variable_manpower_expenses', function (Blueprint $table) {
            $table->id();
            $table->morphs('otherVariableManpowerExpenseAble','otherVariableManpowerExpenseAble');
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
        Schema::dropIfExists('other_variable_manpower_expense');
    }
}
