<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRichtingenTable extends Migration
{
    /**
     * Run the migrations.
     * @table richtingen
     *
     * @return void
     */
    public function up()
    {
        Schema::create('richtingen', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('naam', 255);

            $table->unique(["id"], 'unique_richtingen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('richtingen');
    }
}