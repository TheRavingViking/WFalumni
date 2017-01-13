<?php

use Illuminate\Database\Seeder;

class add_comment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert(array(
            array('user_id' => '10000', 'voornaam' => 'John', 'achternaam' => 'Doe', 'tussenvoegsel' => 'test', 'rating' => '1', 'comment' => 'Quo dicta ullam et id.'),
            array('user_id' => '10000', 'voornaam' => 'John', 'achternaam' => 'Doe', 'tussenvoegsel' => 'test', 'rating' => '2', 'comment' => 'Cupiditate ipsa dolorum labore officia ullam labore in amet.'),
            array('user_id' => '10000', 'voornaam' => 'John', 'achternaam' => 'Doe', 'tussenvoegsel' => 'test', 'rating' => '5', 'comment' => 'Ut eum fuga doloremque omnis perspiciatis reprehenderit consectetur.')
        ));

    }
}
