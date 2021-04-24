<?php

namespace Luckykenlin\LivewireTables\Tests\Database\Factories;

use Faker\Generator;
use Luckykenlin\LivewireTables\Tests\Models\DummyBelongsToManyModel;
use Luckykenlin\LivewireTables\Tests\Models\DummyHasManyModel;
use Luckykenlin\LivewireTables\Tests\Models\DummyHasOneModel;

/* @var Illuminate\Database\Eloquent\Factory $factory */

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
