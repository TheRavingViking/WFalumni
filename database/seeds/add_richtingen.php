<?php

use Illuminate\Database\Seeder;

class add_richtingen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('richtingen')->insert(array(
            array('naam'=>'Business'),
            array('naam'=>'Management'),
            array('naam'=>'Social Work'),
            array('naam'=>'Health'),
            array('naam'=>'ICT'),
            array('naam'=>'Technology'),
            array('naam'=>'Law'),
            array('naam'=>'Education')

        ));
    }
}