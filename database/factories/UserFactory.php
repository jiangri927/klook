<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('adminadmin'), // password
            'remember_token' => Str::random(10),
            'title' => $this->faker->title,
            'first_name' => $this->faker->firstName,
            'second_name' => $this->faker->lastName,
            'country' => $this->faker->country,
            'countryCode' => $this->faker->countryCode,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'postcode' => $this->faker->postcode,
            'number' => $this->faker->e164PhoneNumber,
            'avatar' => $this->faker->imageUrl(),
            'birthday' => $this->faker->date(),
            'aiva_username' => $this->faker->userName,
            'am_status' => ['Yes','No'][$this->faker->numberBetween(0,1)],
            'status' => ['Active','Inactive'][$this->faker->numberBetween(0,1)],
            'credits' => $this->faker->numberBetween(50,500),
            'abp' => $this->faker->numberBetween(50,3000)
        ];
    }
}
