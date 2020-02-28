<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gallery;

use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'created_by' => rand(1,10)
    ];
});
