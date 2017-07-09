<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Event;
use App\EventType;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // First day of this month
        $sd = new DateTime('first day of this month');
        
        // First day of this month
        $ld = new DateTime('last day of this month');
        
        $data = \App\Event::select('title','start','end','EVENTTYPES.name as type_name')->join('EVENTTYPES','EVENTTYPES.id','=','EVENTS.type_id')->get();
        
        //$sd = strtotime("25-01-2012 00:00:00");
        //$sd = $sd->getTimestamp();
        //$sd = date_timestamp_get($sd);
        //$sd = $sd->createFromFormat("DD-MM-YY","21-01-2012", new DateTimeZone("Asia/Calcutta"));
        //$sd = new DateTime('25/01/2012',new DateTimeZone("Asia/Calcutta"));
        
        $var = "21/01/2012";
        $date = str_replace('/', '-', $var);
        $sd= date("Y-m-d", strtotime($date) );
        return response()
            ->json([
                'form' => $data,
                'startdate' => $sd,
                'lastdate' => $ld,
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
        return response()
            ->json([
                'form' => Event::initialize(),
                'option' => []
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
        $data = \App\Event::where([['id','=','1']])->get();
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
        $events = Event::findOrFail($id);

        return response()
            ->json([
                'form' => $events,
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
    public function destroy(Event $event)
    {
        //
    }
    
    public function getEventTypes(Request $request){
        $data = \App\EventType::select('name','color')->get();
        return response()->json($data);
    }
}
?>