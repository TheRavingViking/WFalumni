<?php
/**
 * Created by PhpStorm.
 * User: Laurens Albers
 * Date: 15-12-2016
 * Time: 13:34
 */
$factory->define(App\user_role::class, function (Faker\Generator $faker) {

    $faker->addProvider(new Faker\Provider\nl_NL\person($faker));

    $number = array('1', '2', '3');


    return [

        'role_id'=> $faker->randomElement($number),

];

});



