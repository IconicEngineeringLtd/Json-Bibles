<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('created_by');
          $table->longText('image');
          $table->longText('thumbnail_small');
          $table->string('header')->nullable();
          $table->longText('content')->nullable();
          $table->integer('position')->nullable();
          $table->integer('privacy')->default(1);
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
        Schema::dropIfExists('sliders');
    }
}
