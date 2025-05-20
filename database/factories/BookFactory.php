<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'author' => $faker->name,
        'publisher' => $faker->company,
        'description' => $faker->sentence,
        'year' => $faker->year,
        'isbn' => $faker->unique()->isbn13,
        'quantity_total' => 5, //$faker->numberBetween(5, 20),
        'quantity_available' => 5, //$faker->numberBetween(0, 20),
        'status' => 'ativo', //$faker->randomElement(['ativo', 'inativo']),
        'cover_image' => NULL
    ];
});
