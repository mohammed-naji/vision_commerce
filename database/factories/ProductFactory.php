<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->words(2, true);
        return [
            'name' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraphs(4, true),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(50, 200),
            'quantity' => $this->faker->numberBetween(50, 200),
            'discount' => $this->faker->numberBetween(10, 70),
            'category_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
