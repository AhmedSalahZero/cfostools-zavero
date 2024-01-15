<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuickPricingCalculatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quick_pricing_calculators', function (Blueprint $table) {
            $table->id();
              $table->unsignedBigInteger('revenue_business_line_id');
            $table->foreign('revenue_business_line_id')->references('id')->on('revenue_business_lines')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('service_category_id');
            $table->foreign('service_category_id')->references('id')->on('service_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('service_item_id');
            $table->foreign('service_item_id')->references('id')->on('service_items')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('service_nature_id');
            $table->foreign('service_nature_id')->references('id')->on('service_natures')->cascadeOnDelete()->cascadeOnUpdate();
            $table->double('delivery_days');
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
        Schema::dropIfExists('quick_pricing_calculators');
    }
}
