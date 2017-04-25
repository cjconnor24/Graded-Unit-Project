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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
    ];
});

$factory->define(App\Branch::class,function(Faker\Generator $faker){
    return [
      'name'=>$faker->company,
        'address1' => $faker->streetAddress,
        'address2' => $faker->streetName,
        'address3' => $faker->city,
        'address4'=>$faker->state,
        'postcode'=>$faker->postcode,
        'email'=>$faker->userName."@spectrumdubai.com",
        'telephone'=>$faker->phoneNumber

    ];
});

$factory->define(App\Address::class, function (Faker\Generator $faker){
    return [
        'name' => $faker->company,
        'address1' => $faker->streetAddress,
        'address2' => $faker->streetName,
        'address3' => $faker->city,
        'address4'=>$faker->state,
        'postcode'=>$faker->postcode,
    ];
});
