<?php

use Illuminate\Database\Seeder;

class add_bedrijf extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bedrijf')->insert(array(
            array('user_id'=>'10000', 'functie'=>'Chirurg', 'richting'=>'Zorg', 'naam'=>'Flevoziekenhuis', 'locatie'=>'Almere', 'begin'=>'2014-03-19', 'eind'=>NULL, 'telefoonnummer'=>'06-12345678', 'bezoekadres'=>'Teletubbylaan 4', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),

            array('user_id'=>'10000', 'functie'=>'Verpleger', 'richting'=>'Zorg', 'naam'=>'Flevoziekenhuis', 'locatie'=>'Almere', 'begin'=>'2013-08-01', 'eind'=>'2014-03-18', 'telefoonnummer'=>'06-12345678', 'bezoekadres'=>'Teletubbylaan 4', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'10000', 'functie'=>'Schoonmaker', 'richting'=>'Zorg', 'naam'=>'Flevoziekenhuis', 'locatie'=>'Almere', 'begin'=>'2010-01-24', 'eind'=>'2013-7-31', 'telefoonnummer'=>'06-12345678', 'bezoekadres'=>'Teletubbylaan 4', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
        ));
    }
}