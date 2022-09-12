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
        Schema::create('userquizzes', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('block_id');
<<<<<<<< HEAD:database/migrations/2022_09_07_002457_create_userquizzes_table.php
            $table->enum('status',['Pending','Done'])->default('Pending');
========
            $table->enum('status',['Pending','Submitted','Initiated','Checked'])->default('Pending');
            $table->double('block_aggregate',8,2)->nullable();
>>>>>>>> 19e7f8329ba84fdfad82a9cb601135aa7e2876d2:database/migrations/2022_09_02_054051_create_userquizzes_table.php
            $table->string('started_at')->nullable();
            $table->string('submitted_at')->nullable();
            $table->timestamps();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userquiz');
    }
};