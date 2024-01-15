<?php

use App\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeStatementItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_statement_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('has_sub_items')->default(true);
            $table->boolean('has_depreciation_or_amortization')->default(false);
            $table->boolean('is_main_for_all_calculations')->default(false);
            $table->boolean('is_sales_rate')->default(false);
            $table->json('depends_on')->nullable()->comment('auto-calculated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_statement_items');
    }
}
