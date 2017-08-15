<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Auth;
use App\Models\Event;
use App\Models\EventType;
use App\Http\Controllers\HearingsController;
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
        
        $sdate = new DateTime('first day of this month');
        
        // First day of this month
        $edate = new DateTime('last day of this month');
        
        $isMonthView = true;
        $data = $this->getEventsArr($sdate, $edate, $isMonthView);
        
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
        $event = Event::initialize();
        $event_types = EventType::select('id','name')->get();
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
        $event_array = $request->all();
        
        $start_date = $event_array['start'];
        $end_date = $event_array['end'];
        
        $event_array['start'] = $this->convertDateToLong($start_date);
        $event_array['end'] = $this->convertDateToLong($end_date);
        
        $date = new DateTime();
        $event_array['created_at'] = $date->getTimeStamp();
        $event_array['updated_at'] = $date->getTimeStamp();
        
        $event_array['org_id'] = Auth::user()->org_id;
        
        $event = Event::create($event_array);
        
        return response()->json([
            //'saved' => true,
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
        $data = Event::where([['id','=','1']])->get();
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
        $data = EventType::select('name','color')->get();
        return response()->json($data);
    }
    
    public function dateChange(){
        $sd = new DateTime('first day of this month');
        
        // First day of this month
        $ld = new DateTime('last day of this month');
        
        $data = Event::select('title','start','end','EVENTTYPES.name as type_name')->join('EVENTTYPES','EVENTTYPES.id','=','EVENTS.type_id')->get();
        
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
    
    public function convertDateToLong($date){
        $date = str_replace('/', '-', $date);
        $sd= new DateTime(date("Y-m-d H:i:s", strtotime($date)));
        //  print_r (new DateTime($sd));
        return $sd->getTimeStamp()."000";
    }
    
    public function convertLongToDate($date, $format){
        $date = new DateTime(date('d-m-Y H:i:s', $date/1000));
        //$date->setTimeZone(new DateTimeZone('Asia/Calcutta'));
        if($format == null || $format == ''){
            $format = 'Y-m-d';
        }
        return $date->format($format);
    }
    public function getEventsArr($sdate, $edate, $isMonthView){
        date_modify($sdate,'-10 day');
        date_modify($edate,'+10 day');
        $sd = $sdate->getTimestamp()."000";
        $ed = $edate->getTimestamp()."000";
        
        $query = Event::select('EVENTS.id','title','start','end','EVENTTYPES.name as type_name','EVENTTYPES.color as backgroundColor')->join('EVENTTYPES','EVENTTYPES.id','=','EVENTS.type_id');
        
        if($isMonthView){
            $query->where([
                ['EVENTS.start','>=',$sd],
                ['EVENTS.end','<',$ed]
            ]);
        }else{
            $query->where('EVENTS.start','>=',$sd)->orWhere('EVENTS.end','<',$ed);
        }
        
        $data = $query->get();
        
        foreach ($data as $key => $event){
            $data[$key]['start'] = $this->convertLongToDate($data[$key]['start'], 'Y-m-d');
            $data[$key]['end'] = $this->convertLongToDate($data[$key]['end'], 'Y-m-d');
            $data[$key]['borderColor'] = $data[$key]['backgroundColor'];
        }
        return $data;
    }
    
    public function getAllEventsCount(){
        $data = Event::count();
        return $data;
    }
    public function getTodaysEvents(){
        $sdate = (new DateTime())->format('Y-m-d 00:00:00');
        $sdate = DateTime::createFromFormat('Y-m-d H:i:s', $sdate);
        // First day of this month
        $edate = (new DateTime())->format('Y-m-d 23:59:59');
        $edate = DateTime::createFromFormat('Y-m-d H:i:s', $edate);
        $isMonthView = false;
        $data = $this->getEventsArr($sdate, $edate, $isMonthView);
        return $data;
    }
    
    public function getEventsList(Request $request)
    {
        $stDate = $request->sdate;
        $sdate = new DateTime('now');
        $edate = new DateTime('now');
        if($stDate != 'undefined' && $stDate != ''){
            $sdate = new DateTime($stDate);
            $edate = clone $sdate;
        }
        
        // First day of this month
        $sdate = $sdate->modify('first day of this month');
        $edate = $edate->modify('last day of this month');
        
        $isMonthView = true;
        $data = $this->getEventsArr($sdate, $edate, $isMonthView);
        return response()->json($data);
        
    }
}
?>