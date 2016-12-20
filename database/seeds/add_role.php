<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
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
    }
}
