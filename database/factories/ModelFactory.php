<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Curema\Models\User::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('da_DK');

    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(60),
    ];
});

$factory->define(Curema\Models\App\Account::class, function (Faker\Generator $faker) {
    $faker = Faker\Factory::create('da_DK');

    return [
        'user_id' => $faker->numberBetween(1, 50),
        'name' => $faker->company(),
        'street_name' => $faker->streetName(),
        'street_number' => $faker->buildingNumber(),
        'city' => $faker->city(),
        'zip' => $faker->postcode(),
        'country' => 'Danmark',
        'cvr' => $faker->cvr,
        'phone' => $faker->phoneNumber(),
        'email' => $faker->email(),
        'website' => $faker->domainName(),
    ];
});
