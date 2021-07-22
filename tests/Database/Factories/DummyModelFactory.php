<?php

namespace Luckykenlin\LivewireTables\Tests\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Luckykenlin\LivewireTables\Tests\Models\DummyModel;

class DummyModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DummyModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject' => $this->faker->sentence,
            'category' => $this->faker->word,
            'body' => $this->faker->paragraph,
            'flag' => $this->faker->boolean(),
            'expires_at' => $this->faker->dateTimeBetween('now', '+ 4 weeks'),
        ];
    }
}
