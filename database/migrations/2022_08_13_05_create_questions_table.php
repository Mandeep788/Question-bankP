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
<<<<<<< HEAD
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
            $table->float('experience')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->enum('role',['admin','user','editor'])->default('user');
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
=======
            $table->unsignedBigInteger('framework_id');
            $table->foreign('framework_id')->references('id')->on('frameworks')->onDelete('cascade');
            $table->unsignedBigInteger('experience_id');
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
            $table->text('question');
>>>>>>> 19e7f8329ba84fdfad82a9cb601135aa7e2876d2
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