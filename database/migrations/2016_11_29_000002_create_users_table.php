<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('isDeleted')->default('1');
            $table->string('voornaam', 255);
            $table->string('tussenvoegsel', 255)->nullable();
            $table->string('achternaam', 255);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('nationaliteit', 255)->nullable();
            $table->string('geboorteland', 255)->nullable();
            $table->string('geboorteprovincie', 255)->nullable();
            $table->string('geboorteplaats', 255)->nullable();
            $table->date('geboortedatum')->nullable();
            $table->string('geslacht', 5)->nullable();
            $table->string('titel', 255)->nullable();
            $table->text('foto')->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('remember_token', 100)->nullable()->default(null);
            $table->string('burgerlijke_staat', 45)->nullable();
            $table->boolean('heeft_kinderen')->nullable()->default('0');
            $table->integer('jaarinkomen')->nullable();
            $table->boolean('geenmailverzenden')->nullable()->default('0');
            $table->string('post_adres', 255)->nullable();
            $table->integer('studentnummer')->nullable();
            $table->string('telefoonnummer', 15)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('website', 255)->nullable();

            $table->unique(["email"], 'unique_users');
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
       Schema::dropIfExists('users');
     }
}
