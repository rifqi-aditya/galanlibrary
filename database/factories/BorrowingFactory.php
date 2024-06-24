<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'book_id' => $this->faker->numberBetween(1, 200),
            'number_of_books' => $this->faker->numberBetween(1, 10),
            'should_return_at' => $this->faker->date(),
            'return_date' => null,
            'return_status' => null,
        ];
    }
}
