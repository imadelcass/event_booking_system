<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use App\Services\PaymentService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    public function __construct(public PaymentService $paymentService) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Booking $booking)
    {
        Gate::authorize('create', Payment::class);

        $payment = $this->paymentService->processPayment($booking);

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
