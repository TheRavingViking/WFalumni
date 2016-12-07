<?php

use Illuminate\Database\Seeder;

class add_real_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array('voornaam'=>'john', 'achternaam'=>'doe', 'linkedin' => 'www.linkedin.com', 'email' => 'test' . '@test.com', 'password' => '$2y$10$bRsD96BYEgyv1Dn1scV1xuTfIq4ICIda7FYU0c3QghazXN4FNRk8G', 'foto'=>'default.png' ),
            array('voornaam'=>'Jessica', 'achternaam'=>'Jones', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test', 'foto'=>'default.png'),
            array('voornaam'=>'Tony', 'achternaam'=>'Stark', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test', 'foto'=>'default.png'),
            array('voornaam'=>'Stephen', 'achternaam'=>'Strange', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test', 'foto'=>'default.png' ),
            array('voornaam'=>'Bruce', 'achternaam'=>'Banner', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test', 'foto'=>'default.png' ),
            array('voornaam'=>'Peter', 'achternaam'=>'Parker', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test', 'foto'=>'default.png' ),
            array('voornaam'=>'Natascha', 'achternaam'=>'Romanoff', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test', 'foto'=>'default.png' ),
            array('voornaam'=>'Luke', 'achternaam'=>'Cage', 'linkedin' => 'www.linkedin.com', 'email' => str_random(10) . '@gmail.com', 'password' => 'test', 'foto'=>'default.png' ),
        ));
    }
}
