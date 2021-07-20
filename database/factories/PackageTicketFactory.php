<?php

namespace Database\Factories;

use App\Models\PackageTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PackageTicket::class;

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
            'm_price' => $this->faker->randomFloat(2,100,150),
            'o_price' => $this->faker->randomFloat(2,50,100),
            'o_percent' => $this->faker->randomFloat(0,50,100),
            'abp_price' => $this->faker->randomFloat(2,100,150),
            'abp_amount' => $this->faker->randomFloat(2,50,100),
            'abp_percent' => $this->faker->randomFloat(0,50,100),
        ];
    }
}
