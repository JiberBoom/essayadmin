<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'pic'=>'http://www.jiberboom.top/storage/person_default.png',
        'remember_token' => str_random(10),
    ];
});
