<?php

use App\Models\Tenant\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomNumber(5),

        'name' => $faker->company,

        'email' => $faker->unique()->email,

        'verified' => '1',

        'monthly_payment' => $faker->randomFloat(2, 0, 9999.99),
    ];
});

$factory->state(Supplier::class, 'verified', [
    'verified' => '1',
]);
