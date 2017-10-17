<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'nickname' => $faker->name,
        'website'=>$faker->url,
        'qq'=>$faker->numberBetween(1000000,9999999),
        'weixin'=>$faker->name,
        'password' => $password ?: $password = bcrypt('secret'),
        'pic'=>'http://jiberboom.top/public/storage/person_default.png',
        'remember_token' => str_random(10),
    ];
});
