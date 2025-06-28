<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author_id' => null,  // assign this later when creating or seeding
            'isbn' => fake()->isbn13(),
            'publicationYear' => fake()->year(),
            'generation' => fake()->randomElement(['1st', '2nd', '3rd', '4th']),
            'availableCopies' => fake()->numberBetween(1, 100),
        ];
    }
}
