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
    return [
        'name' => 'Reza Jaya',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin'),
        'roles' => 'admin',
        'remember_token' => str_random(10),
    ];
});
