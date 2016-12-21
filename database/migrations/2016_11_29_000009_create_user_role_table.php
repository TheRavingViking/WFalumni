<?php
//
//use Illuminate\Support\Facades\Schema;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
//
//class CreateUserRoleTable extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        Schema::create('user_role', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('user_id')->unsigned();
//            $table->integer('role_id')->unsigned();
//
//            $table->softDeletes();
//            $table->nullableTimestamps();
//
//
//            $table->foreign('user_id', 'fk_user_id_idx')
//                ->references('id')->on('users')
//                ->onDelete('no action')
//                ->onUpdate('no action');
//
//            $table->foreign('role_id', 'fk_roles_id_idx')
//                ->references('id')->on('roles')
//                ->onDelete('no action')
//                ->onUpdate('no action');
//
//
//        });
//    }
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        Schema::drop('user_role');
//    }
//}