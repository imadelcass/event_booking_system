<?php

namespace App\Services;

use App\Enums\BookingStatusEnum;
use App\Enums\PaymentStatusEnum;
use App\Models\Booking;
use App\Models\Payment;

class PaymentService
{
    /**
     * Process a payment for a given booking.
     */
    public function processPayment(Booking $booking): Payment
    {
        // Simulate payment processing logic
        $isSuccessful = true;

        // Create payment record
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount'     => $booking->ticket->price * $booking->quantity,
            'status'     => $isSuccessful ? PaymentStatusEnum::SUCCESS : PaymentStatusEnum::FAILED,
        ]);

        // Update booking status based on payment result
        $booking->status = $isSuccessful ? BookingStatusEnum::CONFIRMED : BookingStatusEnum::CANCELLED;
        $booking->save();

        return $payment;
    }
}
