<?php

use Faker\Generator;
use Luckykenlin\LivewireTables\Tests\Models\DummyBelongsToManyModel;
use Luckykenlin\LivewireTables\Tests\Models\DummyHasManyModel;
use Luckykenlin\LivewireTables\Tests\Models\DummyHasOneModel;
use Luckykenlin\LivewireTables\Tests\Models\DummyModel;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(DummyModel::class, function (Generator $faker) {
    return [
        'subject' => $faker->sentence,
        'category' => $faker->word,
        'body' => $faker->paragraph,
        'flag' => $faker->boolean(),
        'expires_at' => $faker->dateTimeBetween('now', '+ 4 weeks'),
    ];
});

$factory->define(DummyHasOneModel::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(DummyHasManyModel::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(DummyBelongsToManyModel::class, function (Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
