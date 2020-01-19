<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('created_by');
          $table->string('supplier_id');
          $table->string('category_id');
          $table->string('sub_category_id')->nullable();
          $table->string('brand_id');
          $table->string('model')->nullable();
          $table->string('title');
          $table->string('url');
          $table->longText('tags')->nullable();
          $table->bigInteger('price')->default(0);
          $table->bigInteger('discount_ratio')->default(0);
          $table->string('status')->default(1);
          $table->longText('overview')->nullable();
          $table->longText('features')->nullable();
          $table->longText('specifications')->nullable();
          $table->longText('includes')->nullable();
          $table->longText('accessories')->nullable();
          $table->string('meta_title')->nullable();
          $table->string('meta_slug')->nullable();
          $table->longText('meta_description')->nullable();
          $table->longText('meta_keywords')->nullable();
          $table->longText('product_image')->nullable();
          $table->longText('thumbnail_small')->nullable();
          $table->longText('thumbnail_medium')->nullable();
          $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('products');
    }
}
