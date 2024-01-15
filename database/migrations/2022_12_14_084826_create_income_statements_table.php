<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_statements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('duration');
            $table->enum('duration_type',['monthly','annually'])->default('monthly');
            $table->string('start_from');
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
        Schema::dropIfExists('income_statements');
    }
}
