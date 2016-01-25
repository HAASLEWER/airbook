<?php

use Illuminate\Database\Eloquent\Model;

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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName($gender = null),
        'email' => $faker->email,
        'password' => bcrypt('airbook_pass123'),
        'remember_token' => str_random(10),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'lastname' => $faker->lastName,
        'idnumber' => rand(pow(10,12),pow(10,13)-1),
        'idfilepath' => 'NULL',
    ];
});

$factory->define(App\Ticket::class, function (Faker\Generator $faker) {

    return [
        'ticketref' => str_random(10),
        'airline' => $faker->randomElement($array = array ('South African Airways','Kulula','Mango', 'Safair', 'British Airway')),
        'dateofdeparture' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+2 years'),
        'class' => $faker->randomElement($array = array ('Economy','Business','First', 'Premium')),
        'origin' => $faker->randomElement($array = array ('JNB','BFN','CPT', 'DBN')),
        'destination' => $faker->randomElement($array = array ('JNB','BFN','CPT', 'DBN')),
        'roundtrip' => $faker->boolean($chanceOfGettingTrue = 50),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'valid' => $faker->boolean($chanceOfGettingTrue = 50),
        'tradable' => $faker->boolean($chanceOfGettingTrue = 50),
    ];
});

$factory->define(App\Credit::class, function (Faker\Generator $faker) {

    return [
    	'user_id' => $faker->numberBetween($min = 1, $max = 20),
        'trade' => $faker->numberBetween($min = 50, $max = 200),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});