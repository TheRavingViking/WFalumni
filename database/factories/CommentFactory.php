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

$factory->define(App\Comment::class, function (Faker\Generator $faker) {



    return [
        'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'voornaam' => $faker->name,
        'tussenvoegsel' => $faker->name,
        'achternaam' => $faker->name
    ];
});
