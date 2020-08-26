<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quote;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/**
 * Define a quote factory
 * 
 * @param Faker\Generator
 * @return array
 */
$factory->define(Quote::class, function (Faker $faker) {
    return [
        'client_name' => $faker->name,
        'employee_name' => $faker->name,
        'quote_date' => $faker->date($format = 'Y-m-d', $max = '2030-12-31'),
        'quote_time' => $faker->time($format = 'H:i'),
        'quote_description' => $faker->sentence(),
        'quote_id' => Str::random(9),
        'quoted_value' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5000),
    ];
});
