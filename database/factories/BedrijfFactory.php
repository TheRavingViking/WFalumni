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
    return [
        'functie' => $faker->name,
        'richting' => $faker->name,
        'naam' => $faker->company,
        'locatie' => $faker->city,
        'begin' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'eind' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'telefoonnummer' => $faker->phoneNumber,
        'bezoekadres' => $faker->address,
        'land' => $faker->country,

    ];
});
