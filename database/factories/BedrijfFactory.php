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

$factory->define(App\Bedrijf::class, function (Faker\Generator $faker) {

    $faker->addProvider(new Faker\Provider\nl_NL\Company($faker));

    $richting = array('Business', 'ICT', 'Law');

    return [
        'functie' => $faker->name,
        'richting' => $faker->randomElements($richting),
        'naam' => $faker->company,
        'straatnaam' => $faker->address,
        'postcode' => $faker->postcode,
        'stad' => $faker->city,
        'begin' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'eind' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'telefoonnummer' => $faker->phoneNumber,
        'bezoekadres' => $faker->address,
        'land' => $faker->country,
        'latitude' => $faker->latitude($min = 51, $max = 54),
        'longitude' => $faker->longitude($min = 4, $max = 7),

    ];
});
