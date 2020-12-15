<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('roles', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->string('rle_name');
        });
        $this->addDefaultRoles();
    }

    private function addDefaultRoles(){
        $this->insertRole(1, 'Admin');
        $this->insertRole(2, 'Responsable');
        $this->insertRole(3, 'Enseignant');
        $this->insertRole(4, 'Étudiant');
    }


    private function insertRole(int $id, string $name){
        DB::table('roles')->insert([
            'id' => $id,
            'rle_name' => $name,
        ]);
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('roles');
    }

}
