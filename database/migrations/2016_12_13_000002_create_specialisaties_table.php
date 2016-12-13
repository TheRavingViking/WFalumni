<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialisatiesTable extends Migration
{
    /**
     * Run the migrations.
     * @table specialisaties
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialisaties', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('naam', 255);
            $table->integer('opleidingen_id')->unsigned();

            $table->unique(["id"], 'unique_specialisaties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialisaties');
    }
}