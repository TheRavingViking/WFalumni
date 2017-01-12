<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     * @table users
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('comment', 255)->nullable();
            $table->string('voornaam', 255)->nullable();
            $table->string('tussenvoegsel', 255)->nullable();
            $table->string('achternaam', 255)->nullable();
            $table->integer('rating')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('docent_id')->unsigned();
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('user_id', 'fk_comments_users_idx')
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
       Schema::dropIfExists('comments');
     }
}
