<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('sbj_name');
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->foreignId('formation_id')->references('id')->on('formations')->onDelete('cascade');
            $table->foreignId('year_id')->references('id')->on('years')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
