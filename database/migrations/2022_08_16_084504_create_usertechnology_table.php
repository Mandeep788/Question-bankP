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
        Schema::create('usertechnology', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->integer('framework_id')->unsigned();
            $table->integer('experience_id')->unsigned();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('framework_id')->references('id')->on('frameworks');
            $table->foreign('experience_id')->references('id')->on('experiences');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usertechnology');
    }
};
