<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Auth;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = EventType::select('id','name','color')->get();
        return response()->json($data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $event = EventType::initialize();
        $event_types = EventType::select('id', 'name', 'color')->get();
        return response()
            ->json([
                'form' => $event,
                'option' => ['event_types' => $event_types],
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $eventType_array = $request->all();
        $date = new DateTime();
        $eventType_array['created_at'] = (new DateTime())->getTimestamp()."000";
        $eventType_array['updated_at'] = (new DateTime())->getTimestamp()."000";
        
        $event = EventType::create($eventType_array);
        
        return response()->json([
            'saved' => true,
            'event' => $event,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = EventType::where([['id','=',$id]])->get();
        return response()->json([
            'model' => $data
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $eventTypes = EventType::findOrFail($id);

        return response()
            ->json([
                'form' => $eventTypes,
                'option' => []
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventType $eventtype)
    {
        //
        $status = $eventtype->delete();
        return response()
            ->json([
                'deleted' => $status,
            ]);
    }
    
    public function getEventTypes(Request $request){
        $data = EventType::select('name','color')->get();
        return response()->json($data);
    }
    
}
?>