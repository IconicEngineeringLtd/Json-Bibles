<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->string('url');
          $table->string('user_id');
          $table->longText('banner')->nullable();
          $table->integer('banner_privacy')->default(1);
          $table->longText('cover')->nullable();
          $table->integer('cover_privacy')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
