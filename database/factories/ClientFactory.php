<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
        'First_Name' => $faker->firstName,
        'Last_Name' => $faker->lastName,
        'Phone_Number' => $faker->phoneNumber,
        'SB_Eligibility' => $faker->boolean($chanceOfGettingTrue = 15)
    ];
});
