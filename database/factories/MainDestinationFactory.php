<?php

namespace Database\Factories;

use App\Models\MainDestination;
use Illuminate\Database\Eloquent\Factories\Factory;

class MainDestinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MainDestination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->country,
            'info' => $this->faker->paragraph
        ];
    }
}
