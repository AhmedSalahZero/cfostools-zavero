<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable();
            $table->enum('status', ['test_table', 'save_to_table']);
            $table->string('model_name');
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
        Schema::dropIfExists('active_jobs');
    }
}
