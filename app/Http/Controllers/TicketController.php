<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\TicketRequest;
use App\Models\Event;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request, Event $event)
    {
        Gate::authorize('create', Ticket::class);

        $ticket = Ticket::create($request->validated() + ['event_id' => $event->id]);

        return response()->json($ticket, Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        Gate::authorize('update', $ticket);

        $ticket->update($request->validated());

        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        Gate::authorize('delete', $ticket);

        $ticket->delete();

        return response()->noContent();
    }
}
