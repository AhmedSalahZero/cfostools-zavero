<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable();
            $table->enum('collection_base', ['general_collection_policy', 'branch', 'business_sector', 'sales_channel', 'zone']);
            $table->json('general_collection')->nullable();
            $table->json('first_allocation_collection')->nullable();
            $table->json('second_allocation_collection')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection_settings');
    }
}
