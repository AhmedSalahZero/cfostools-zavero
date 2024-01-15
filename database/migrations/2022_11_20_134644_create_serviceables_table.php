<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('serviceables', function (Blueprint $table) {
            $table->id();
            $table->morphs('serviceable'); // quotation_pricing_calculator ; 
            $table->unsignedBigInteger('revenue_business_line_id');
            $table->foreign('revenue_business_line_id')->references('id')->on('revenue_business_lines');
            $table->unsignedBigInteger('service_category_id');
            $table->foreign('service_category_id')->references('id')->on('service_categories');
            $table->unsignedBigInteger('service_item_id');
            $table->foreign('service_item_id')->references('id')->on('service_items');   
            $table->unsignedBigInteger('service_nature_id');
            $table->foreign('service_nature_id')->references('id')->on('service_natures');
            $table->double('delivery_days')->default(0);
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
        Schema::create('quotation_pricing_calculator_service', function (Blueprint $table) {
            //
        });
    }
}
