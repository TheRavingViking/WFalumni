<?php
use App\Role;
use App\User;
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
            array('id'=>'10000', 'voornaam'=>'john', 'achternaam'=>'doe', 'linkedin' => 'www.linkedin.com', 'email' => 'test' . '@test.com', 'password' => '$2y$10$bRsD96BYEgyv1Dn1scV1xuTfIq4ICIda7FYU0c3QghazXN4FNRk8G', 'foto'=>'default.png'),




    ));







    }
}
