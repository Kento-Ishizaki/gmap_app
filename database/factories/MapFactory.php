<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Map;
use Faker\Generator as Faker;

$factory->define(Map::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 4),
        'place' => $faker->city,
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'date' => $faker->dateTimeBetween('0years', '1years'),
        'lat' => $faker->latitude($min = '32', $max = '45'),
        'lng' => $faker->longitude($min = '135', $max = '145'),
    ];
});
