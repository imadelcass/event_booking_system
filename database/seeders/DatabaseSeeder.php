<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create specific roles
        $admins = User::factory(2)->create(['role' => 1]);
        $organizers = User::factory(3)->create(['role' => 2]);
        $customers = User::factory(10)->create(['role' => 3]);

        // Create events for organizers
        $events = Event::factory(5)->create([
            'created_by' => $organizers->random()->id,
        ]);

        // Create tickets for events
        $tickets = Ticket::factory(15)->create([
            'event_id' => $events->random()->id,
        ]);

        // Create bookings for customers
        $bookings = Booking::factory(20)->create([
            'user_id' => $customers->random()->id,
            'ticket_id' => $tickets->random()->id,
        ]);

        // Create payments for bookings
        foreach ($bookings as $booking) {
            Payment::factory()->create([
                'booking_id' => $booking->id,
                'amount' => $booking->ticket->price * $booking->quantity,
            ]);
        }
    }
}
