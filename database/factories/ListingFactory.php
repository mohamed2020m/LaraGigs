<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->jobTitle(), 
            'tags' => 'php, laravel, C#',
            'company' => fake()->company(),
            'location' => fake()->streetName(),
            'email' => fake()->companyEmail,
            'website' => fake()->url,
            'description' => fake()->paragraph(3),
        ];
    }
}
