<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->string('url');
          $table->string('country')->nullable();
          $table->string('user_id');
          $table->string('meta_title')->nullable();
          $table->string('meta_slug')->nullable();
          $table->longText('meta_description')->nullable();
          $table->longText('meta_keywords')->nullable();
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
        Schema::dropIfExists('brands');
    }
}
