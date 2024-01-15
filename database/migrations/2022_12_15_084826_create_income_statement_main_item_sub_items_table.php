<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeStatementMainItemSubItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_statement_main_item_sub_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('income_statement_id');
            $table->foreign('income_statement_id', 'income_statement_foreign2')->references('id')->on('income_statements');
            $table->unsignedBigInteger('income_statement_item_id');
            $table->foreign('income_statement_item_id', 'income_report_id2')->references('id')->on('income_statement_items');
            $table->string('sub_item_name')->nullable()->default(null)->comment('when null it stores the main row data that has no sub rows');
            $table->json('payload')->nullable();
            $table->boolean('is_depreciation_or_amortization')->nullable()->default(false);
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
        Schema::dropIfExists('income_statement_main_item_sub_items');
    }
}
