<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'author' => $faker->name,
        'publisher' => $faker->company,
        'year' => $faker->year,
        'isbn' => $faker->unique()->isbn13,
        'quantity_total' => $total = $faker->numberBetween(1, 15),
        'quantity_available' => $total,
        'status' => 'ativo',
    ];
});
