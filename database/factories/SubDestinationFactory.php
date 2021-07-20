<?php

namespace Database\Factories;

use App\Models\SubDestination;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubDestinationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubDestination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->city,
            'promo1' => $this->faker->paragraph,
            'promo2' => $this->faker->paragraph,
            'info1' => $this->faker->paragraph,
            'info2' => $this->faker->paragraph,
        ];
    }
}
