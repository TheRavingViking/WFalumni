<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWoonplaatsTable extends Migration
{
    /**
     * Run the migrations.
     * @table woonplaats
     *
     * @return void
     */
    public function up()
    {
        Schema::create('woonplaats', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->string('plaatsnaam', 45);
            $table->date('begin');
            $table->date('eind')->nullable();
            $table->string('longitude', 255)->nullable();
            $table->string('latitude', 255)->nullable();
            $table->string('land', 255);
            $table->string('provincie', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('woonplaats');
     }
}
