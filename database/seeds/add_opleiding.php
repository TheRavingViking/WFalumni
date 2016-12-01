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
            array('user_id'=>'1', 'naam'=>'Software Development', 'instituut'=>'Windesheim Flevoland', 'richting'=>'ICT', 'begin'=>'2014-03-19', 'eind'=>'2016-01-01', 'locatie'=>'Almere', 'niveau'=>'AD', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'2', 'naam'=>'Logopedie', 'instituut'=>'Windesheim Flevoland', 'richting'=>'Health', 'begin'=>'2013-03-19', 'eind'=>'2015-01-01', 'locatie'=>'Almere', 'niveau'=>'Bachelor', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'2', 'naam'=>'Bouwkunde', 'instituut'=>'Windesheim Flevoland', 'richting'=>'Technology', 'begin'=>'2010-01-23', 'eind'=>'2012-06-07', 'locatie'=>'Almere', 'niveau'=>'Bachelor', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'3', 'naam'=>'Leraar Basisonderwijs', 'instituut'=>'Windesheim Flevoland', 'richting'=>'Education', 'begin'=>'2010-05-13', 'eind'=>'2014-08-24', 'locatie'=>'Almere', 'niveau'=>'Bachelor', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'4', 'naam'=>'Ondernemen', 'instituut'=>'Windesheim Flevoland', 'richting'=>'Business', 'begin'=>'2012-03-19', 'eind'=>'2014-08-11', 'locatie'=>'Almere', 'niveau'=>'AD', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'5', 'naam'=>'Pedagogiek', 'instituut'=>'Windesheim Flevoland', 'richting'=>'Social work', 'begin'=>'2015-06-30',  'eind'=>NULL,'locatie'=>'Almere', 'niveau'=>'Bachelor', 'behaald'=>'0', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'6', 'naam'=>'HBO-Rechten', 'instituut'=>'Windesheim Flevoland', 'richting'=>'Law', 'begin'=>'1970-03-19',  'eind'=>NULL, 'locatie'=>'Almere', 'niveau'=>'Bachelor', 'behaald'=>'0', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'7', 'naam'=>'Gymnasium', 'instituut'=>'Het Baken', 'richting'=>'N&T', 'begin'=>'2019-03-19', 'eind'=>'2045-07-21', 'locatie'=>'Almere', 'niveau'=>'VWO', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'8', 'naam'=>'Applicatieontwikkelaar', 'instituut'=>'ROC Flevoland', 'richting'=>'ICT', 'begin'=>'2008-05-04', 'eind'=>'2011-01-01', 'locatie'=>'Almere', 'niveau'=>'MBO', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),
            array('user_id'=>'8', 'naam'=>'Software Development', 'instituut'=>'Windesheim Flevoland', 'richting'=>'ICT', 'begin'=>'2011-03-19', 'eind'=>'2013-04-26', 'locatie'=>'Almere', 'niveau'=>'AD', 'behaald'=>'1', 'Land'=>'Nederland', 'provincie'=>'Flevoland'),

        ));
    }
}