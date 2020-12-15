<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('years', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('yrs_name');
        });
        $this->addDefaultYear();
    }


    private function addDefaultYear(){
        $this->insertFormation(1, 'Licence 1');
        $this->insertFormation(2, 'Licence 2');
        $this->insertFormation(3, 'Licence 3');
        $this->insertFormation(4, 'Master 1');
        $this->insertFormation(5, 'Master 2');
    }


    private function insertFormation(int $id, string $name){
        DB::table('years')->insert([
            'id' => $id,
            'yrs_name' => $name,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('years');
    }
}
