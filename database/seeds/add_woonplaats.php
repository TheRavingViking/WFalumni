<?php

use Illuminate\Database\Seeder;

class add_woonplaats extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('woonplaats')->insert(array(
            array('user_id'=>'10000', 'naam'=>'Almere', 'begin'=>'2014-03-19', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),

        ));
    }
}