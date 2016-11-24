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
            $table->integer('users_id')->unsigned();
            $table->string('functie', 255);
            $table->string('richting', 255);
            $table->string('bedrijfsnaam', 255);
            $table->string('locatie', 255);
            $table->date('begin');
            $table->date('eind')->nullable();
            $table->string('bedrijfstelefoonnummer', 15)->nullable();
            $table->string('bezoek adres', 255)->nullable();


            $table->foreign('users_id', 'fk_bedrijf_users1_idx')
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
