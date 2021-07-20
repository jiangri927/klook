<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->streetName,
            'info' => $this->faker->streetAddress,
            'faq' => $this->faker->streetAddress,
            'things' => $this->faker->streetAddress,
            'look_for' => $this->faker->streetAddress,
            'category' => $this->faker->name,
            'subcategory' => $this->faker->name,
            'region' => $this->faker->randomElement(['South East','America','Africa','Europe']),
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'top_thing' =>$this->faker->randomElement(['on','off']),
            'recommend' => $this->faker->randomElement(['on','off']),
            'reviews' => $this->faker->randomDigit,
            'booked' => $this->faker->randomDigit,
            'package' => 3,
            'ticket' => 9,
            'status'=>'Active'
        ];
    }
}
