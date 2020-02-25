<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'body' => $faker->text,
        'created_by' => 1,
        "liked_by" => 1

    ];
});
