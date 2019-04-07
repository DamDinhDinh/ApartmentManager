<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => "Dịch vụ: ".$faker->word,
        'price' => $fake->numberBetween(5000, 500000),
        'payment_method' => $faker->numberBetween(1,2),
        'use_method' => $faker->numberBetween(1,2),
        'description' => $fake->text
    ];
});
