<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpleidingenTable extends Migration
{
    /**
     * Run the migrations.
     * @table opleidingen
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opleidingen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('naam', 255);
            $table->integer('richtingen_id')->unsigned();

            $table->unique(["id"], 'unique_opleidingen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opleidingen');
    }
}
