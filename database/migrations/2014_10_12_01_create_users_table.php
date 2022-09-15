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
            $table->id('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('gender',['M','F'])->nullable();
            $table->string('image')->nullable();
            $table->integer('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('designation')->nullable();
            $table->string('current_company')->nullable();
            $table->string('last_company')->nullable();
            $table->string('userTechnology')->nullable();
            $table->float('experience')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->enum('role',['admin','user','editor'])->default('user');
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
