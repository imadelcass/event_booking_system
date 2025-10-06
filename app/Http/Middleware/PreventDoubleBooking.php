<?php

namespace App\Http\Middleware;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Models\Ticket;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventDoubleBooking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $alreadyBooked = Booking::where('user_id', auth()->id())
            ->where('ticket_id', $request->ticket->id)
            ->whereNot('status', BookingStatusEnum::CANCELLED)
            ->exists();

        if ($alreadyBooked) {
            return response()->json([
                'error' => __('validation.custom.ticket.already_booked')
            ], 403);
        }

        return $next($request);
    }
}
