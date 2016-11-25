<?php

use Illuminate\Database\Seeder;

class add_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array('voornaam'=>'john', 'achternaam'=>'doe', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test' ),
            array('voornaam'=>'Jessica', 'achternaam'=>'Jones', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test' ),
            array('voornaam'=>'Tony', 'achternaam'=>'Stark', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test' ),
            array('voornaam'=>'Stephen', 'achternaam'=>'Strange', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test' ),
            array('voornaam'=>'Bruce', 'achternaam'=>'Banner', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test' ),
            array('voornaam'=>'Peter', 'achternaam'=>'Parker', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test' ),
            array('voornaam'=>'Natascha', 'achternaam'=>'Romanoff', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test' ),
            array('voornaam'=>'Luke', 'achternaam'=>'Cage', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test' ),

        ));
    }
}
