<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return QueryBuilder::for(Event::class)
            ->allowedFilters(['name', 'date', 'location'])
            ->allowedSorts(['name', 'date', 'created_at'])
            ->paginate(...__paginate($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event->load(['tickets']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        Gate::authorize('create', Event::class);

        $data = $request->validated() + ['created_by' => auth()->id()];

        $event = Event::create($data);

        return response()->json($event, Response::HTTP_CREATED);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        Gate::authorize('update', $event);

        $event->update($request->validated());

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        Gate::authorize('delete', $event);
        
        $event->delete();

        return response()->noContent();
    }
}
