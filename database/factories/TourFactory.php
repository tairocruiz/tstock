<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(), 
            'slug' => fake()->word(), 
            'seo_title' => fake()->words(), 
            'meta_description' => fake()->text(50), 
            'photo' => fake()->image('public/images/tours_images'), 
            'price' => fake()->numberBetween(100, 10000), 
            'days' => fake()->numberBetween(1, 40), 
            'tour_category_id' => fake()->numberBetween(1, 200),
        ];
    }
}
