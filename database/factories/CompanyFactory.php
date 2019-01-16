<?php

use App\Models\Address;
use App\Models\Company\Company;
use App\Models\Company\User;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    $phone = $faker->regexify("/A[0-9]{2}B[1-4]{4}-[0-9]{4}/");

    $phone = str_replace(['A', 'B'], ['(', ')'], $phone);

    return [
        'name' => $faker->company,
        'phone' => $phone,
        'cnpj' => '21.325.516/0001-86',
    ];
});

$factory->state(Company::class, 'relationships', function ($faker) {
  
    $phone = $faker->regexify("/A[0-9]{2}B[1-4]{4}-[0-9]{4}/");

    $phone = str_replace(['A', 'B'], ['(', ')'], $phone);
 
    return [
        'name' => $faker->company,
        'phone' => $phone,
        'cnpj' => '74.002.607/0001-47',
        'users' => function () {
            return [factory(User::class)->states('create')->raw()];
        },
        'addresses' => function () {
            return [factory(Address::class)->raw()];
        },
    ];
});
