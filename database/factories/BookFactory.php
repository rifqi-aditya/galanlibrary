<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->sentence(100),
            'author' => $this->faker->name(),
            'publisher_id' => $this->faker->numberBetween(1, 5),
            'publication_year' => $this->faker->year(),
            'stock' => $this->faker->numberBetween(1, 50),
            'category_id' => $this->faker->numberBetween(1, 5),
            'cover' => null
        ];
    }
}
