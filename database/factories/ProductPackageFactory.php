<?php

namespace Database\Factories;

use App\Models\ProductPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductPackage::class;

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
            'description' => $this->faker->streetAddress,
            'terms' => $this->faker->streetAddress,
            'guide' => $this->faker->streetAddress,
            'ticket' => 3,
            'availability' => $this->faker->date('yy-mm-dd').','.$this->faker->date('yy-mm-dd')
        ];
    }
}
