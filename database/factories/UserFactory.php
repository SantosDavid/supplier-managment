<?php

use Faker\Generator as Faker;
use App\Models\Tenant\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'password' => $faker->password,
    ];
});

$factory->state(User::class, 'create', [
    'password' => '123456',
    'password_confirmation' => '123456',
]);
