<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpleidingTable extends Migration
{
    /**
     * Run the migrations.
     * @table opleiding
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opleiding', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->string('opleidingsnaam', 255);
            $table->string('instituut', 255);
            $table->date('begin');
            $table->date('eind')->nullable();
            $table->string('locatie', 255);
            $table->string('niveau', 45);
            $table->boolean('behaald')->default('0');


            $table->foreign('users_id', 'fk_opleiding_users_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('opleiding');
     }
}
