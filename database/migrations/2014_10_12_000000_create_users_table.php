<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->string('nickname');
          $table->string('username')->unique();
          $table->string('email')->unique();
          $table->timestamp('email_verified_at')->nullable();
          $table->integer('role')->default(0)->nullable();
          $table->string('mobile')->unique();
          $table->string('mobile_verified_at')->nullable();
          $table->string('dob');
          $table->string('nidn');
          $table->string('nidn_verified_at')->nullable();
          $table->string('brn');
          $table->string('brn_verified_at')->nullable();
          $table->string('gender');
          $table->longText('address');
          $table->string('password');
          $table->ipAddress('ipAddress')->nullable();
          $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
