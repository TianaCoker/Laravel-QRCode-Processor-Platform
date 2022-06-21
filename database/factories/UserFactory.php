<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;


$factory->define(App\Models\User::class, function (Faker $faker) {
      
    $passwordHash = Hash::make('secret');
    $rememberToken = str_random(10);

    return [
        'name' => $faker->name,
        'role_id' => rand(1,4),
        'email' => $faker->unique()->safeEmail,
        'password' => $passwordHash,
        'remember_token' => $rememberToken,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
