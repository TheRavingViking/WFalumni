<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedrijfTable extends Migration
{
    /**
     * Run the migrations.
     * @table bedrijf
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bedrijf', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('functie', 255);
            $table->string('richting', 255);
            $table->string('naam', 255);
            $table->string('locatie', 255);
            $table->date('begin');
            $table->date('eind')->nullable();
            $table->string('telefoonnummer', 15)->nullable();
            $table->string('bezoekadres', 255)->nullable();
            $table->string('land', 255);
            $table->string('provincie', 255)->nullable();
            $table->integer('alumni_id')->unsigned();


            $table->foreign('alumni_id', 'fk_bedrijf_alumni1_idx')
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
       Schema::dropIfExists('bedrijf');
     }
}
