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
    $foto = array('default.png', 'default2.png', 'default3.png');


    return [

        'geslacht'=> $faker->randomElement($geslacht),
        'voornaam' => $faker->firstName,
        'studentnummer' => $faker->numberBetween($min = 100000, $max = 999999),
        'achternaam' => $faker->lastName,
        'email' => $faker->unique()->email,
        'foto' => $faker->randomElement($foto),
        'linkedin' => 'www.linkedin.com',
        'facebook' => 'www.facebook.com',
        'password' => $faker->password,
        'telefoonnummer' => $faker->phoneNumber,
        'nationaliteit' => $faker->country,
        'geboorteland' => $faker->country,
        'geboorteplaats' => $faker->city,
        'geboortedatum' => $faker->dateTime,
        'titel' => $faker->title,
        'bevoegdheid' => $faker->numberBetween($min = 1, $max = 3),
        'jaarinkomen' => $faker->numberBetween($min = 0, $max = 200000),
        'heeft_kinderen' => $faker->numberBetween($min = 0, $max = 1)



    ];


});
