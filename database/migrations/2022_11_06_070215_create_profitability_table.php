<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitabilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profitabilities', function (Blueprint $table) {
            $table->id();
            $table->morphs('profitabilityAble','profitAble');
            $table->float('percentage')->default(0);
            $table->float('net_profit_after_taxes')->default(0);
            $table->float('vat')->default(0);
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
        Schema::dropIfExists('general_expenses');
    }
}
