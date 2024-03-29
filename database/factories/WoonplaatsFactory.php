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

$factory->define(App\Woonplaats::class, function (Faker\Generator $faker) {


    $faker->addProvider(new Faker\Provider\nl_NL\Address($faker));

    return [
        'naam' => $faker->city,
        'postcode' => $faker->postcode,
        'begin' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'eind' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'latitude' => $faker->latitude($min = 51, $max = 54),
        'longitude' => $faker->longitude($min = 4, $max = 7),
        'land' => $faker->country,
        'provincie' => $faker->state,

    ];
});
