<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Book;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'user_id' => User::factory(),
            'title'=>fake()->sentence(3),
            'author'=>fake()->name(),
            'description'=>fake()->paragraph(),
            'cover_image'=>null,
            'book_file' => null,
            'published_year'=>fake()->numberBetween(1900, 2026),
            'isbn' => fake()->unique()->numerify('978-##########'),

        ];
    }
}
