<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {

    $faker->addProvider(new Faker\Provider\nl_NL\Person($faker));

    $geslacht = array('Man', 'Vrouw');
    $number = array('1', '1');


    return [

        'geslacht'=> $faker->randomElement($geslacht),
        'voornaam' => $faker->firstName,
        'studentnummer' => $faker->numberBetween($min = 100000, $max = 999999),
        'achternaam' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'foto' => 'default.png',
        'linkedin' => 'www.linkedin.com',
        'password' => $faker->password,
        'telefoonnummer' => $faker->phoneNumber,
        'nationaliteit' => $faker->country,
        'geboorteland' => $faker->country,
        'geboorteplaats' => $faker->city,
        'geboortedatum' => $faker->dateTime,
        'titel' => $faker->title,
        'bevoegdheid' => $faker->randomElement($number),
        'jaarinkomen' => $faker->numberBetween($min = 0, $max = 100000),



    ];


});
