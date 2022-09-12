<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender',['M','F','O'])->nullable();
            $table->text('address')->nullable();
            $table->text('last_company')->nullable();
            $table->text('current_company')->nullable();
            $table->text('experience')->nullable();
            $table->text('phone_number')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->enum('role',['admin','user','editor'])->default('user');
            $table->timestamp('last-login')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};