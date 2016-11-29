<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersoneelTable extends Migration
{
    /**
     * Run the migrations.
     * @table personeel
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personeel', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('bevoegdheid')->default('99');
            $table->boolean('isDeleted')->default('0');
            $table->string('voornaam', 255);
            $table->string('tussenvoegsel', 255)->nullable();
            $table->string('achternaam', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->text('foto')->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('remember_token', 100)->nullable()->default(null);
            $table->string('telefoonnummer', 15)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('richting', 255);
            $table->string('opleiding1', 255)->nullable();
            $table->string('opleiding2', 255)->nullable();
            $table->string('opleiding3', 255)->nullable();

            $table->unique(["email"], 'unique_personeel');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('personeel');
     }
}
