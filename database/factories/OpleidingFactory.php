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



$factory->define(App\Opleiding::class, function (Faker\Generator $faker) {

    $naam = array('Leraar basisonderwijs', 'AD Ondernemen', 'AD Software Development');
    $instituut = array('windesheim Flevoland', 'ROC Almere', 'HVA');
    $richting = array('Business', 'ICT', 'Law');

    return [
        'naam' => $faker->randomElement($naam),
        'instituut' => $faker->randomElement($instituut),
        'richting' => $faker->randomElement($richting),
        'begin' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'eind' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'locatie' => 'Almere',
        'niveau' => 'HBO',
        'behaald' => $faker->boolean,
        'land' => 'Nederland',
    ];
});
