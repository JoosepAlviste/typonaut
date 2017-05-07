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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Game::class, function (Faker\Generator $faker) {
    return [
        'player_one_id' => function () {
            return factory('App\User')->create()->id;
        },
        'player_two_id' => function () {
            return factory('App\User')->create()->id;
        },
        'player_one_score' => intval($faker->randomFloat(0, 0, 10)),
        'player_two_score' => function (array $game) {
            return 10 - $game['player_one_score'];
        },
    ];
});

$factory->define(App\Round::class, function (Faker\Generator $faker) {
    return [
        'game_id' => function () {
            return factory('App\Game')->create()->id;
        },
        'word' => function () use ($faker) {
            return $faker->word;
        },
        'player_one_time' => function () use ($faker) {
            return $faker->randomFloat(2, 1, 10);
        },
        'player_two_time' => function () use ($faker) {
            return $faker->randomFloat(2, 1, 10);
        },
    ];
});
