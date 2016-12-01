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
            array('users_id'=>'1', 'naam'=>'Almere', 'begin'=>'2014-03-19', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('users_id'=>'2', 'naam'=>'Zaandam', 'begin'=>'2014-03-19', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('users_id'=>'2', 'naam'=>'Urk', 'begin'=>'2012-01-01', 'eind'=>'2014-01-01', 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('users_id'=>'2', 'naam'=>'Almere', 'begin'=>'2000-05-15', 'eind'=>'2011-12-31', 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('users_id'=>'2', 'naam'=>'Amsterdam', 'begin'=>'1990-01-12', 'eind'=>'2000-01-01', 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('users_id'=>'3', 'naam'=>'Almere', 'begin'=>'2014-03-19', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('users_id'=>'3', 'naam'=>'Beijing', 'begin'=>'2011-01-01', 'eind'=>'2013-12-31', 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'China', 'provincie'=>NULL),
            array('users_id'=>'3', 'naam'=>'Almere', 'begin'=>'2010-06-25', 'eind'=>'2010-12-31', 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('users_id'=>'4', 'naam'=>'Valencia', 'begin'=>'2011-01-09', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Spanje', 'provincie'=>NULL),
            array('users_id'=>'4', 'naam'=>'Almere', 'begin'=>'2010-01-04', 'eind'=>'2011-01-01', 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('users_id'=>'5', 'naam'=>'Madrid', 'begin'=>'2012-02-29', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Spanje', 'provincie'=>NULL),
            array('users_id'=>'6', 'naam'=>'Milan', 'begin'=>'2015-01-11', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Italie', 'provincie'=>'Flevoland'),
            array('users_id'=>'7', 'naam'=>'Maanstad', 'begin'=>'2009-03-19', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Maan', 'provincie'=>'Nieuw Flevoland'),
            array('users_id'=>'8', 'naam'=>'Jupiterdam', 'begin'=>'2056-01-23', 'eind'=>NULL, 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Jupiter', 'provincie'=>NULL),
            array('users_id'=>'8', 'naam'=>'Almere', 'begin'=>'2010-06-16', 'eind'=>'2045-01-24', 'longitude'=>'8.657057', 'latitude'=>'91.582031', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
        ));
    }
}