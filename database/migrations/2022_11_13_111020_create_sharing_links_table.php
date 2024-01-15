<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSharingLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sharing_links', function (Blueprint $table) {
            $table->id();
            $table->text('link');
            $table->string('identifier');
            $table->string('user_name')->nullable();
            $table->morphs('shareable');
            $table->boolean('is_active');
            $table->double('number_of_views')->default(0);
            // $table->unsignedBigInteger('creator_id')->nullable();
            // $table->foreign('creator_id','creator_id_shareable')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->timestamps();
            
            $table->sharedColumns();
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            
            // $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sharing_links');
    }
}
