<?php

use Illuminate\Database\Seeder;

class add_role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
            public function run()
    {

        DB::table('roles')->insert(array(
            array('id'=>'1', 'name'=>'1', 'description'=>'Alumnus'),
            array('id'=>'2', 'name'=>'2', 'description'=>'OpleidingsAdmin'),
            array('id'=>'3', 'name'=>'3', 'description'=>'SuperAdmin'),

        ));

//        $role_user = new Role();
//        $role_user->name = '1';
//        $role_user->description = 'Alumnus';
//        $role_user->save();
//        $role_author = new Role();
//        $role_author->name = '2';
//        $role_author->description = 'OpleidingsAdmin';
//        $role_author->save();
//        $role_admin = new Role();
//        $role_admin->name = '3';
//        $role_admin->description = 'SuperAdmin';
//        $role_admin->save();
    }
}
