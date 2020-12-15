<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('type_educations', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('te_name');
        });
        $this->addDefaultModules();
    }

    private function addDefaultModules(){
        $this->insertModule(1, 'CM-TD');
        $this->insertModule(2, 'TP');
    }


    private function insertModule(int $id, string $name){
        DB::table('type_educations')->insert([
            'id' => $id,
            'te_name' => $name,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('type_educations');
    }
}
