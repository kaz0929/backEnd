<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'img'=> $faker->imageUrl(),
        'title' => $faker->text(10),
        'content' => $faker->text($maxNbChars = 100),
    ];
});
