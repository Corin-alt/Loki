<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('groups', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('grp_name');
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->foreignId('type_education_id')->references('id')->on('type_educations')->onDelete('cascade');
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
        Schema::dropIfExists('groups');
    }
}
