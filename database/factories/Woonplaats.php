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
    return [
        'naam' => $faker->city,
        'begin' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'eind' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now'),
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'land' => $faker->country,
        'provincie' => $faker->state,

    ];
});
