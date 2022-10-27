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
        Schema::table('userquizzes', function (Blueprint $table) {
            $table->integer('email_flag')->unique()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userquizzes', function (Blueprint $table) {
            $table->integer('email_flag')->unique()->default(0);
        });
    }
};
