<?php

use Illuminate\Database\Seeder;

class add_opleiding extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('opleiding')->insert(array(
            array('user_id'=>'10000', 'naam'=>'AD Software Development', 'instituut'=>'Windesheim Flevoland', 'richting'=>'ICT', 'begin'=>'2014-03-19', 'eind'=>'2016-01-01', 'locatie'=>'Almere', 'niveau'=>'AD', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),

        ));
    }
}