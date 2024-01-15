<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('revenue_business_line_id');
            $table->foreign('revenue_business_line_id')->references('id')->on('revenue_business_lines')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->foreign('creator_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('service_categories');
    }
}
