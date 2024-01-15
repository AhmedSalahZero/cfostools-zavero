<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomizedFieldsExportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customized_fields_exportations', function (Blueprint $table) {
            $table->id();
            $table->json('fields');
            $table->string('model_name');
            $table->unsignedBigInteger('company_id');
            //FOREIGN KEY CONSTRAINTS
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('customized_fields_exportations');
    }
}
