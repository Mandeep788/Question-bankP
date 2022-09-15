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
        Schema::create('user_assessments', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('block_question_id');
            $table->text('answer')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('quiz_id');
            $table->double('marks_per_ques',8,2)->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();
            $table->foreign('block_question_id')->references('id')->on('block_questions')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('userquizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_assessments');
    }
};
