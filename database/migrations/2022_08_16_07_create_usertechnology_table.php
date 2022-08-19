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
            $table->id('id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('framework_id');
            $table->unsignedBigInteger('experience_id');
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
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
