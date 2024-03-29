<?php

namespace Database\Factories;

use App\Models\ProductGallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductGalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductGallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'gallery_url' => $this->faker->imageUrl(1280,1028),
            'extension' => $this->faker->fileExtension,
        ];
    }
}
