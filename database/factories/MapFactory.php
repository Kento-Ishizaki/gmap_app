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
        'date' => $faker->datetime($min = 'now', $timezone = date_default_timezone_get()),
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'created_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
        'updated_at' => $faker->datetime($max = 'now', $timezone = date_default_timezone_get()),
    ];
});
