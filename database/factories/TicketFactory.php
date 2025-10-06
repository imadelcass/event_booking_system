<?php

namespace Database\Factories;

use App\Enums\TicketTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(TicketTypeEnum::cases()),
            'price' => fake()->randomFloat(2, 20, 200),
            'quantity' => fake()->numberBetween(50, 500),
            'event_id' => \App\Models\Event::factory(),
        ];
    }
}
