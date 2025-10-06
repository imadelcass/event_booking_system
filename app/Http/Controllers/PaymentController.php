<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Models\Payment;
use App\Http\Requests\PaymentRequest;
use App\Models\Booking;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request, Booking $booking)
    {
        Gate::authorize('create', Payment::class);

        $data = $request->validated() +
            ['booking_id' => $booking->id, 'status' => PaymentStatusEnum::SUCCESS->value];
        $payment = Payment::create($data);

        return response()->json($payment, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        Gate::authorize('view', $payment);

        return response()->json($payment);
    }
}
