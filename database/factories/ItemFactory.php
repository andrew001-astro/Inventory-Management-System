<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'no' => Str::upper(Str::random(3)) . random_int(100, 999),
        'name' => $faker->word(),
        'price' => $faker->numberBetween(100,9999)
    ];
});
