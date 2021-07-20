<?php

namespace Database\Factories;

use App\Models\WelcomeGallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class WelcomeGalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WelcomeGallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'path' => $this->faker->imageUrl(1280,300),
            'extension' => $this->faker->fileExtension,
            'name' => $this->faker->name,
            'kind' => 'welcome',
            'kind_id' => 1
        ];
    }
}
