<?php

namespace Database\Factories;

use App\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'ticket_id' => \App\Models\Ticket::factory(),
            'quantity' => fake()->numberBetween(1, 5),
            'status' => fake()->randomElement(BookingStatusEnum::cases()),
        ];
    }
}
