<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Product\Infrastructure\Repository\DAO\ProductDAO::class, function (Faker\Generator $faker) {

    return [
            'name' => $faker->sentence,
            'price' => $faker->randomDigitNotNull,
            'currency' => $faker->randomElement(['PLN', 'USD'])
    ];
});