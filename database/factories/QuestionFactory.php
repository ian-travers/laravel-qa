<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/* @var $factory Illuminate\Database\Eloquent\Factory */
$factory->define(App\Question::class, function (Faker $faker) {

    $title = rtrim($faker->sentence(rand(5, 10)), ".");

    return [
        'title' => $title,
        'slug' => Str::slug(
            mb_substr($title, 0, 40)
            . '-'
            . Carbon::now()->format('dmyHi')
        ),
        'body' => $faker->paragraphs(rand(3, 7), true),
        'views' => rand(0, 10),
//        'answers_count' => rand(0, 10),
        'votes' => rand(-3, 7),
    ];
});
