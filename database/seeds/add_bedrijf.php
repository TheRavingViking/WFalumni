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
            array('user_id'=>'1', 'functie'=>'Chirurg', 'richting'=>'Zorg', 'naam'=>'Flevoziekenhuis', 'locatie'=>'Almere', 'begin'=>'2014-03-19', 'eind'=>NULL, 'telefoonnummer'=>'06-12345678', 'bezoekadres'=>'Teletubbylaan 4', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),

            array('user_id'=>'1', 'functie'=>'Verpleger', 'richting'=>'Zorg', 'naam'=>'Flevoziekenhuis', 'locatie'=>'Almere', 'begin'=>'2013-08-01', 'eind'=>'2014-03-18', 'telefoonnummer'=>'06-12345678', 'bezoekadres'=>'Teletubbylaan 4', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'1', 'functie'=>'Schoonmaker', 'richting'=>'Zorg', 'naam'=>'Flevoziekenhuis', 'locatie'=>'Almere', 'begin'=>'2010-01-24', 'eind'=>'2013-7-31', 'telefoonnummer'=>'06-12345678', 'bezoekadres'=>'Teletubbylaan 4', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'2', 'functie'=>'Ingenieur', 'richting'=>'Bouwkunde', 'naam'=>'Goedbouw B.V.', 'locatie'=>'Urk', 'begin'=>'2009-01-01', 'eind'=>'2015-12-31', 'telefoonnummer'=>'06-15554391', 'bezoekadres'=>'Laanstraatpad 18', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'3', 'functie'=>'Vakkenvuller', 'richting'=>'Retail', 'naam'=>'Albert Heijn', 'locatie'=>'Zaandam', 'begin'=>'2011-01-02', 'eind'=>NULL, 'telefoonnummer'=>'06-35329731', 'bezoekadres'=>'Winkellaan', 'Land'=>'Nederland', 'provincie'=>'Noord-Holland'),
            array('user_id'=>'3', 'functie'=>'Bankier', 'richting'=>'Business', 'naam'=>'ABN Amro', 'locatie'=>'Groningen', 'begin'=>'2009-01-01', 'eind'=>'2011-01-01', 'telefoonnummer'=>'06-35121314', 'bezoekadres'=>'Bananenpad 18', 'Land'=>'Soemalie', 'provincie'=>'Groningen'),
            array('user_id'=>'4', 'functie'=>'Rechercheur', 'richting'=>'Overheid', 'naam'=>'Politie Arnhem', 'locatie'=>'Arnhem', 'begin'=>'2024-05-01', 'eind'=>NULL, 'telefoonnummer'=>'06-15124615', 'bezoekadres'=>'Nergens', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'6', 'functie'=>'doet eigenlijk niets', 'richting'=>'links', 'naam'=>'kees', 'locatie'=>'hierzo', 'begin'=>'1380-02-29', 'eind'=>NULL, 'telefoonnummer'=>'06-11114444', 'bezoekadres'=>'Laan 13', 'Land'=>'Holland', 'provincie'=>'Zeeland'),
            array('user_id'=>'7', 'functie'=>'Kok', 'richting'=>'Catering', 'naam'=>'Restaurant Eten', 'locatie'=>'Zeewolde', 'begin'=>'2001-06-04', 'eind'=>'2013-09-21', 'telefoonnummer'=>'06-15129885', 'bezoekadres'=>'Koksstraat 213', 'Land'=>'Japan', 'provincie'=>''),
            array('user_id'=>'8', 'functie'=>'Asielmedewerker', 'richting'=>'Dierenofzo', 'naam'=>'Asiel', 'locatie'=>'Asielstad', 'begin'=>'2011-05-01',  'eind'=>NULL, 'telefoonnummer'=>'06-15124612', 'bezoekadres'=>'Hondenpad 1', 'Land'=>'Asielland', 'provincie'=>'Flevoland'),
            array('user_id'=>'8', 'functie'=>'Manager', 'richting'=>'Business', 'naam'=>'FEBO', 'locatie'=>'Assen', 'begin'=>'2008-05-01', 'eind'=>'2011-01-01', 'telefoonnummer'=>'06-58900034', 'bezoekadres'=>'Wegisweg 87', 'Land'=>'Nederland', 'provincie'=>'Drenthe'),
            array('user_id'=>'8', 'functie'=>'Verkoper', 'richting'=>'Retail', 'naam'=>'Mediamarkt', 'locatie'=>'Zwolle', 'begin'=>'2004-11-17', 'eind'=>'2008-04-30', 'telefoonnummer'=>'06-15124614', 'bezoekadres'=>'Marktlaan', 'Land'=>'Nederland', 'provincie'=>'Noord-Brabant'),
        ));
    }
}