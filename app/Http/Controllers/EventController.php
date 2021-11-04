<?php

namespace App\Http\Controllers;

use App\Http\Requests\Event\EventStoreRequest;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Repositories\EventRepository;
use App\Models\Event;

class EventController extends BaseController
{

    public function __construct(EventRepository $event)
    {
        $this->event = $event;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = $this->event->orderBy('event_date','asc')->get();
        $events = EventResource::collection( $event );
        return $this->success([
            'message' => 'Event Lists',
            'data' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStoreRequest $request)
    {
        
        $data = $request->except('_token','playlist_id');
        $data['created_by'] = auth()->Id();
        if($event = $this->event->create($data)){
            $event->playlists()->sync($request->playlist_id);
            return $this->success([
                'message' => 'Event added Successfully ',
                'data' => new EventResource($event)
            ]);
         }

         return $this->error('Opps Something went wrong pls check the form ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $data = $request->except('_token','playlist_id');
        $data['created_by'] = auth()->Id();
        if($event->update($data)){
            $event->playlists()->sync($request->playlist_id);
            return $this->success([
                'message' => 'Event Update Successfully ',
                'data' => new EventResource($event)
            ]);
         }

         return $this->error('Opps Something went wrong pls check the form ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->playlists()->detach();
        $event->delete();
        return $this->success([
            'message' => 'Song deleted Successfully ',
            'data' => new EventResource($event)
        ]);
    }
}
