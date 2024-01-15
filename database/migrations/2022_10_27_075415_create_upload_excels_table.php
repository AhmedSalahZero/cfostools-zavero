<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadExcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_excels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable();
            // foreach()
            $table->date('date')->nullable();
            $table->string('invoice_date', 50)->nullable();
            $table->string('customer_name', 50)->nullable();
            $table->string('invoice_number', 50)->nullable();
            $table->string('invoice_amount', 50)->nullable();
            $table->string('due_collection_days', 50)->nullable();
            $table->string('due_date', 50)->nullable();
            $table->string('contract_code', 50)->nullable();
            $table->string('contract_date', 50)->nullable();
            $table->string('updated_by', 191)->nullable();
            $table->string('created_by', 191)->nullable();
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
        Schema::dropIfExists('upload_excels');
    }
}
