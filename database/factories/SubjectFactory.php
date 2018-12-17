<?php

use Faker\Generator as Faker;
use App\Subject;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'day' => random_int(1, 9)
    ];
});
