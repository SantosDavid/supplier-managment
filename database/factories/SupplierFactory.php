<?php

use Faker\Generator as Faker;
use App\Models\Company\Supplier;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        
        'email' => $faker->unique()->email,

        'monthly_payment' => $faker->randomFloat(2, 0),
    ];
});
