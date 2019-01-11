<?php

use Faker\Generator as Faker;

/* @var $factory Illuminate\Database\Eloquent\Factory */
$factory->define(\App\Answer::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraphs(rand(3, 6), true),
        'user_id' => App\User::pluck('id')->random(),
//        'votes_count' => rand(0, 5),
    ];
});
