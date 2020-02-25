<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(),
        'body' => $faker->text,
        'created_by' => rand(1,10),
        "liked_by" => 1

    ];
});
