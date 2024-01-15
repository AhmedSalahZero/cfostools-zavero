<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationPricingCalculatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_pricing_calculators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('business_sector_id')->nullable();
            $table->foreign('business_sector_id')->references('id')->on('business_sectors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->sharedPricingCalculatorsColumns();
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
        Schema::dropIfExists('quotation_pricing_calculators');
    }
}
