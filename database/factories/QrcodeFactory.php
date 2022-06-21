<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(App\Models\Qrcode::class, function (Faker $faker) {

    return [
        'user_id' => function(){
            return App\Models\User::all()->random();
        },
        'website' => $faker->url,
        'company_name' => $faker->name,
        'product_name' => $faker->sentence(rand(4, 8) , true),
        'product_url' => $faker->url,
        'callback_url' => $faker->url,
        'qrcode_path' => 'generated_qrcodes/1.png',
        'amount' => rand(100,4000),
        'status' => rand(0, 1)
        
    ];
});
