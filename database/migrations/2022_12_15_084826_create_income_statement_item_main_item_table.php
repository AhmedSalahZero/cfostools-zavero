<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeStatementItemMainItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_statement_item_main_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_statement_id');
            $table->foreign('income_statement_id','income_statement_foreign')->references('id')->on('income_statements');
            $table->unsignedBigInteger('income_statement_item_id');
            $table->foreign('income_statement_item_id','income_report_id')->references('id')->on('income_statement_items');
        //    $table->primary(['income_statement_id','income_statement_item_id'],'mixed_primary_1');
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
        Schema::dropIfExists('income_statement_item_main_item');
    }
}
