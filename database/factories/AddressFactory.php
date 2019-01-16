<?php

use Faker\Generator as Faker;
use App\Models\Address;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'street' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'neighborhood' => $faker->streetSuffix,
        'city' => $faker->city,
        'zipcode' => $faker->regexify('/[0-9]{5}-[0-9]{3}/'),
        'type' => 'thirst',
    ];
});
