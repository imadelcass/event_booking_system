<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatusEnum;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\QueryBuilder;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Booking::class);

        return QueryBuilder::for(Gate::class)
            ->where('user_id', auth()->id())
            ->paginate(...__paginate($request));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request, Ticket $ticket)
    {
        Gate::authorize('create', Booking::class);

        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['ticket_id'] = $ticket->id;
        $data['status'] = BookingStatusEnum::PENDING->value;

        Booking::create($data, Response::HTTP_CREATED);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancel(Booking $booking)
    {
        Gate::authorize('cancel', $booking);

        $booking->status = BookingStatusEnum::CANCELLED->value;
        $booking->save();

        return response()->json($booking);
    }
}
