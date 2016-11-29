<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     * @table events
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('plaats', 255);
            $table->date('datum');
            $table->date('begin');
            $table->date('eind');
            $table->string('naam', 255);
            $table->string('beschrijving', 255);
            $table->string('categorie', 255);
            $table->boolean('isDeleted')->default('0');
            $table->integer('users_id')->unsigned();


            $table->foreign('users_id', 'fk_events_users_idx')
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
       Schema::dropIfExists('events');
     }
}
