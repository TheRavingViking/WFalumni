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
            $table->foreign('opleidingen_id', 'fk_specialisaties_opleidingen_idx')
                ->references('id')->on('opleidingen')
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
        Schema::dropIfExists('specialisaties');
    }
}