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
            $table->foreign('richtingen_id', 'fk_opleidingen_richtingen_idx')
                ->references('id')->on('richtingen')
                ->onDelete('no action')
                ->onUpdate('no action');
            $table->nullableTimestamps();
            $table->softDeletes();
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
