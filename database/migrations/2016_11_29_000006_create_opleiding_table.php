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
            $table->string('naam', 255);
            $table->string('specialisatie', 255);
            $table->string('richting', 255);
            $table->string('instituut', 255);
            $table->date('begin');
            $table->date('eind')->nullable();
            $table->string('locatie', 255);
            $table->string('niveau', 45);
            $table->boolean('behaald')->default('0');
            $table->string('land', 255);
            $table->string('provincie', 255)->nullable();
            $table->integer('user_id')->unsigned();
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('user_id', 'fk_opleiding_users1_idx')
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
