<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->text,
        'category_id' => function(){
            return \App\Models\Category::all()->random();
        },
        'user_id' => function(){
            return \App\Models\User::all()->random();
        }
    ];
});
