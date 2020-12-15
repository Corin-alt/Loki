<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('states', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('stt_name');
        });
        $this->addDefaultStatus();
    }

    private function addDefaultStatus(){
        $this->insertStatus(1, 'Présentiel');
        $this->insertStatus(2, 'Distanciel');
        $this->insertStatus(3, 'Justifiée');
        $this->insertStatus(4, 'Absent');
    }


    private function insertStatus(int $id, string $name){
        DB::table('states')->insert([
            'id' => $id,
            'stt_name' => $name,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('states');
    }
}
