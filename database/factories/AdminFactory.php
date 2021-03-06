<?php

use Faker\Generator as Faker;
use App\Models\Administrator\Admin;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'password' => $faker->password,
    ];
});

$factory->state(Admin::class, 'create', [
    'password' => '123456',
    'password_confirmation' => '123456',
]);
