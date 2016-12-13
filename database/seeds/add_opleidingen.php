<?php

use Illuminate\Database\Seeder;

class add_opleidingen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('opleidingen')->insert(array(
            array('naam'=>'CE', 'richtingen_id'=>'1'),
            array('naam'=>'COM', 'richtingen_id'=>'1'),
            array('naam'=>'SBRM', 'richtingen_id'=>'1'),
            array('naam'=>'AD Ondernemen', 'richtingen_id'=>'1'),
            array('naam'=>'BE', 'richtingen_id'=>'2'),
            array('naam'=>'BRM', 'richtingen_id'=>'2'),
            array('naam'=>'AD Officemanagement', 'richtingen_id'=>'2'),
            array('naam'=>'HRM', 'richtingen_id'=>'2'),
            array('naam'=>'Pedagogiek', 'richtingen_id'=>'3'),
            array('naam'=>'SPH', 'richtingen_id'=>'3'),
            array('naam'=>'MWD', 'richtingen_id'=>'3'),
            array('naam'=>'Logopedie', 'richtingen_id'=>'4'),
            array('naam'=>'Verpleegkunde', 'richtingen_id'=>'4'),
            array('naam'=>'HBO-ICT', 'richtingen_id'=>'5'),
            array('naam'=>'AD Software Development', 'richtingen_id'=>'5'),
            array('naam'=>'Engineering', 'richtingen_id'=>'6'),
            array('naam'=>'RO/Mobiliteit', 'richtingen_id'=>'6'),
            array('naam'=>'Bouwkunde', 'richtingen_id'=>'6'),
            array('naam'=>'AD Bouwkunde', 'richtingen_id'=>'6'),
            array('naam'=>'HBO-Rechten', 'richtingen_id'=>'7'),
            array('naam'=>'Leraar basisonderwijs', 'richtingen_id'=>'8'),
            array('naam'=>'Teachers college', 'richtingen_id'=>'8')

        ));
    }
}