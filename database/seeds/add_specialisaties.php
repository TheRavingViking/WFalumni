<?php

use Illuminate\Database\Seeder;

class add_specialisaties extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialisaties')->insert(array(
            array('naam'=>'Software Engineering', 'opleidingen_id'=>'14'),
            array('naam'=>'Business, IT & Management', 'opleidingen_id'=>'14'),
        ));
    }
}